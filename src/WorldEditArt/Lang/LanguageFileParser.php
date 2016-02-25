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

class LanguageFileParser{
	/** @type resource */
	private $parser;

	/** @type string|null */
	private $buffer = null;
	private $expectingAuthors = false, $valuesMode = false, $justEndedElement = false;
	private $tmpSince = null, $tmpUpdated = null;
	private $stack = [];

	/** @type string */
	private $name;
	/** @type string */
	private $version;
	/** @type string */
	private $relEng;
	/** @type string[] */
	private $authors = [];
	/** @type Translation[] */
	private $values = [];

	public function __construct(string $xml){
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, [$this, "startEl"], [$this, "endEl"]);
		xml_set_character_data_handler($this->parser, [$this, "rawText"]);
		xml_parse($this->parser, $xml, true);
		xml_parser_free($this->parser);
	}

	public function startEl(/** @noinspection PhpUnusedParameterInspection */
		$parser, string $name, array $attr){
		$attr = array_change_key_case($attr, CASE_LOWER);
		if($this->valuesMode){
			$this->stack[] = strtolower($name);
			$this->buffer = "";
			$this->tmpSince = $attr["since"] ?? $this->tmpSince;
			$this->tmpUpdated = $attr["updated"] ?? $this->tmpUpdated;
			$this->justEndedElement = false;
		}elseif($name === "LANGUAGE"){
			$this->name = $attr["name"];
			$this->version = $attr["version"];
			$this->relEng = $attr["rel"] ?? $this->version;
		}elseif($name === "AUTHORS"){
			$this->expectingAuthors = true;
		}elseif($this->expectingAuthors and $name === "AUTHOR"){
			$this->buffer = "";
		}elseif($name === "VALUES"){
			$this->valuesMode = true;
		}
	}

	public function endEl(/** @noinspection PhpUnusedParameterInspection */
		$parser, string $name){
		if($this->valuesMode){
			$key = implode(".", $this->stack);
			array_pop($this->stack);

			if($this->justEndedElement and count($this->stack) > 0){
				$value = trim($this->buffer);
				$this->values[$key] = new Translation($key, $value, $this->tmpSince, $this->tmpUpdated);
				$this->buffer = null;
			}
			$this->justEndedElement = true;
		}
		if($this->expectingAuthors and $name === "AUTHOR"){
			$this->authors[] = trim($this->buffer);
			$this->buffer = null;
		}elseif($name === "AUTHORS"){
			$this->expectingAuthors = false;
		}elseif($name === "VALUES"){
			$this->valuesMode = false;
		}
	}

	public function rawText(/** @noinspection PhpUnusedParameterInspection */
		$parser, string $data){
		if($this->buffer !== null){
			$this->buffer .= $data;
		}
	}

	public function getName(){
		return $this->name;
	}

	public function getVersion(){
		return $this->version;
	}

	public function getRelevantEnglishVersion(){
		return $this->relEng;
	}

	public function getAuthors(){
		return $this->authors;
	}

	public function getValues(){
		return $this->values;
	}

	public function finalize(){
		unset($this->parser, $this->buffer, $this->expectingAuthors, $this->valuesMode, $this->justEndedElement, $this->tmpSince, $this->tmpUpdated, $this->stack);
	}
}
