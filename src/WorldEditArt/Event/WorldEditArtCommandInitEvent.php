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
 * @author LegendsOfMCPE
 */

namespace WorldEditArt\Event;

use WorldEditArt\Command\SubCommand;
use WorldEditArt\WorldEditArt;

class WorldEditArtCommandInitEvent extends WorldEditArtEvent{
	public static $handlerList = null;

	/** @type SubCommand[] */
	private $subCmds = [];

	public function __construct(WorldEditArt $plugin, SubCommand ...$subCmds){
		foreach($subCmds as $subCmd){
			$this->subCmds[strtolower($subCmd->getName())] = $subCmd;
			foreach($subCmd->getAliases() as $alias){
				assert(is_string($alias));
				$alias = strtolower($alias);
				if(isset($this->subCmds[$alias])){
					$plugin->getLogger()->error("Attempt to register command alias //$alias twice");
					continue;
				}
				$this->subCmds[$alias] = $subCmd;
			}
		}
		parent::__construct($plugin);
	}

	public function addSubCommand(SubCommand $subCmd){
		$name = strtolower($subCmd->getName());
		if(isset($this->subCmds[$name])){
			$oldSubCmd = $this->subCmds[$name];
			if($oldSubCmd->getName() === $name){
				throw new \InvalidArgumentException("Subcommand //$name already exists");
			}
			$this->getPlugin()->getLogger()->warning("Overwriting duplicated alias //$name of //{$oldSubCmd->getName()}");
		}
		$this->subCmds[$name] = $subCmd;

		foreach($subCmd->getAliases() as $alias){
			if(!is_string($alias)){
				throw new \TypeError(get_class($subCmd) . " must return string array, " . gettype($alias) . " given");
			}
			$alias = strtolower($alias);
			if(!isset($this->subCmds[$alias])){
				$this->subCmds[$alias] = $subCmd;
			}else{
				$this->getPlugin()->getLogger()->warning("Not overwriting duplicated alias //$alias");
			}
		}
	}

	public function removeSubCommand(SubCommand $subCmd){
		foreach($this->subCmds as $k => $it){
			if($subCmd === $it){
				unset($this->subCmds[$k]);
			}
		}
	}

	/**
	 * @return SubCommand[]
	 */
	public function getSubCommands() : array{
		return $this->subCmds;
	}
}
