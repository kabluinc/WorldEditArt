<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace WorldEditArt\Objects\Space\Cuboid;

use pocketmine\level\Level;
use pocketmine\math\Vector3;
use WorldEditArt\Objects\BlockStream\BlockStream;

class SolidCuboidBlockStream implements BlockStream{
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

	/** @var Level */
	protected $level;
	/** @var Vector3 $temporalVector */
	protected $temporalVector;

	/** @var bool $valid */
	protected $valid = true;

	public function __construct(CuboidSpace $cuboidSpace){
		$cuboidSpace->throwValid();
		$this->level = $cuboidSpace->getLevel();
		$pos1 = $cuboidSpace->getPos1();
		$pos2 = $cuboidSpace->getPos2();
		$this->minX = min($pos1->x, $pos2->x);
		$this->minY = min($pos1->y, $pos2->y);
		$this->minZ = min($pos1->z, $pos2->z);
		$this->maxX = max($pos1->x, $pos2->x);
		$this->maxY = max($pos1->y, $pos2->y);
		$this->maxZ = max($pos1->z, $pos2->z);
		$this->temporalVector = new Vector3($this->minX, $this->minY, $this->minZ);
	}

	public function next(){
		if(!$this->valid){
			return null;
		}
		$return = $this->level->getBlock($this->temporalVector);
		$this->incrementX();
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
}
