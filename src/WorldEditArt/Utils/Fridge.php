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

namespace WorldEditArt\Utils;

use pocketmine\utils\TextFormat;
use WorldEditArt\WorldEditArt;

class Fridge{
	/** @var WorldEditArt $main */
	private $main;
	/** @var object[]|callable[] $container */
	private $container = [];
	/** @var int $nextObjectId */
	private $nextObjectId = 0;

	public function __construct(WorldEditArt $main){
		$this->main = $main;
	}

	/**
	 * @param object|callable $object
	 *
	 * @return int
	 */
	public function store($object){
		$this->container[$id = $this->nextId()] = $object;
		if(count($this->container) >= $this->main->getConfig()->getNested("advanced.objectPool.warningSize")){
			$this->main->getLogger()->warning("OrderedObjectPool size reached " . count($this->container) . "! Object summary:");
			$summary = [];
			foreach($this->container as $obj){
				$class = get_class($obj);
				if(isset($summary[$class])){
					$summary[$class]++;
				}else{
					$summary[$class] = 1;
				}
			}
			foreach($summary as $class => $cnt){
				$this->main->getLogger()->warning($class . ": $cnt entries");
			}
			$this->main->getLogger()->warning("The above is most likely caused by a mistake in code that results in a memory leak. Please report the above to the issue tracker on GitHub at " . TextFormat::LIGHT_PURPLE . "http://lgpe.co/weai/");
		}
		return $id;
	}

	/**
	 * @param int $id
	 *
	 * @return object|callable|null
	 */
	public function get(int $id){
		if(isset($this->container[$id])){
			$object = $this->container[$id];
			unset($this->container[$id]);
			return $object;
		}
		return null;
	}

	/**
	 * Warning: avoid using this method to prevent memory leak
	 *
	 * @param int $id
	 *
	 * @return object|callable|null
	 */
	public function getWithoutClean(int $id){
		return isset($this->container[$id]) ? $this->container[$id] : null;
	}

	/**
	 * @return int
	 */
	private function nextId() : int{
		return $this->nextObjectId++;
	}
}
