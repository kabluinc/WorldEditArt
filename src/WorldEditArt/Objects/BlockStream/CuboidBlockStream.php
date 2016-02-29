<?php

/*
 * WorldEditArt
 *
 * Copyright (C) 2016 PEMapModder
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

namespace WorldEditArt\Objects\BlockStream;

use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\math\Vector3;

abstract class CuboidBlockStream implements BlockStream{
	/** @var Level $level */
	protected $level;
	/** @var int $minX */
	protected $minX;
	/** @var int $minY */
	protected $minY;
	/** @var int $minZ */
	protected $minZ;
	/** @var int $maxX */
	protected $maxX;
	/** @var int $maxY */
	protected $maxY;
	/** @var int $maxZ */
	protected $maxZ;

	/** @var Vector3 $temporalVector */
	protected $temporalVector;
	/** @var bool $valid */
	protected $valid = true;

	public function __construct(Level $level, Vector3 $min, Vector3 $max){
		$this->level = $level;
		$min = $min->floor();
		$max = $max->floor();
		$this->minX = $min->x;
		$this->minY = $min->y;
		$this->minZ = $min->z;
		$this->maxX = $max->x;
		$this->maxY = $max->y;
		$this->maxZ = $max->z;
		$this->temporalVector = $min;
	}

	public function next(){
		$return = null;
		while($return === null or !$this->accept($return)){
			if(!$this->valid){
				return null;
			}
			$return = $this->level->getBlock($this->temporalVector);
			$this->incrementX();
		}
		return $return;
	}

	private function incrementX(){
		$this->temporalVector->x++;
		if($this->temporalVector->x > $this->maxX){
			$this->incrementY();
			$this->temporalVector->x = $this->minX;
		}
	}

	private function incrementY(){
		$this->temporalVector->y++;
		if($this->temporalVector->y > $this->maxY){
			$this->incrementZ();
			$this->temporalVector->y = $this->minY;
		}
	}

	private function incrementZ(){
		$this->temporalVector->z++;
		if($this->temporalVector->z > $this->maxZ){
			$this->valid = false;
		}
	}

	protected function accept(/** @noinspection PhpUnusedParameterInspection */
		Block $block) : bool{
		return true;
	}
}
