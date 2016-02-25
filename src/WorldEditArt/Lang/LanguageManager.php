<?php

/*
 * WorldEditArt
 *
 * Copyright (C) 2016 LegendsOfMCPE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author LegendsOfMCPE Team
 */

namespace WorldEditArt\Lang;

use WorldEditArt\WorldEditArt;

class LanguageManager{
	/** @type WorldEditArt $main */
	private $main;

	/** @type Translation[][] */
	private $translations = [];

	/** @type LanguageFileParser[] */
	private $langs = [];

	public function __construct(WorldEditArt $main){
		$this->main = $main;

		$dir = $main->getDataFolder() . "lang/";
		if(!is_dir($dir)){
			mkdir($dir);
			$it = new \DirectoryIterator($main->getResourceFolder("lang/"));
			/** @type \SplFileInfo $file */
			foreach($it as $file){
				copy($file->getPathname(), $dir . $file->getBasename());
			}
		}

		foreach(new \DirectoryIterator($dir) as $file){
			if($file->getExtension() === "xml"){
				$this->main->getLogger()->info("Loading {$file->getBasename()}...");
				$this->parse(file_get_contents($file->getPathname()));
			}
		}

		if(!isset($this->langs["en"])){
			$this->main->getLogger()->alert("en.xml missing in lang folder! Default en.xml will be loaded as fallback language.");
			$this->parse($this->main->getResourceContents("lang/en.xml"));
		}
	}

	private function parse(string $langFile){
		$parser = new LanguageFileParser($langFile);
		foreach($parser->getValues() as $id => $term){
			if(!isset($this->translations[$id][$parser->getName()])){
				$this->translations[$id][$parser->getName()] = $term;
			}
		}
		$parser->finalize();
		$this->langs[$parser->getName()] = $parser;
	}

	public function getTerm(string $id, string ...$langs) : string{
		if(isset($this->translations[$id])){
			$trans = $this->translations[$id];
			foreach($langs as $lang){
				if(isset($trans[$lang])){
					return $trans[$lang];
				}
			}
			if(isset($trans["en"])){
				return $trans["en"];
			}else{
				$this->main->getLogger()->error("Failed to find undefined (from en.xml) string '$id'");
				return $id;
			}
		}else{
			$this->main->getLogger()->error("Failed to find undefined string '$id'");
			return $id;
		}
	}
}
