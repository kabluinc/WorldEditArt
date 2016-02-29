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

class HollowCuboidBlockStream extends SolidCuboidBlockStream{
	/** @var int $step */
	private $step = 0;
	// [XY (-Z), XY (+Z), YZ' (-X), YZ' (+X), X'Z' (-Y), X'Z' (+Y)]
	// foreach as AB (C): A++; A>max => B++; B>max => ++step, re-adapt ABC

	/** @var int $lengthX */
	private $lengthX;
	/** @var int $lengthY */
	private $lengthY;
	/** @var int $lengthZ */
	private $lengthZ;

	public function __construct(CuboidSpace $cuboidSpace){
		parent::__construct($cuboidSpace);

		$this->lengthX = $this->maxX - $this->minX + 1;
		$this->lengthY = $this->maxY - $this->minY + 1;
		$this->lengthZ = $this->maxZ - $this->minZ + 1;
	}

	public function next(){
		if(!$this->valid){
			return null;
		}

		$return = $this->level->getBlock($this->temporalVector);

		if($this->step === 0 or $this->step === 1){ // front and back with edge (XY)
			$this->temporalVector->x++; // increment through X

			if($this->temporalVector->x > $this->maxX){ // X loop completed
				$this->temporalVector->x = $this->minX; // reset X for looping
				$this->temporalVector->y++; // increment through Y

				if($this->temporalVector->y > $this->maxY){ // Y loop completed
					if(($this->step++) === 0){ // change to the other side across Z
						$this->temporalVector->y = $this->minY; // reset Y for looping
						$this->temporalVector->z = $this->maxZ; // the Z component jumps to the other side

					}else{ // adapt to step 2
//						$this->temporalVector->x = $this->minX; // I didn't forget this, but this is already run, coincidentally.
						$this->temporalVector->y = $this->minY; // reset Y of YZ' for looping
						$this->temporalVector->z = $this->minZ + 1; // reset Z' of YZ' for looping
					}
				}
			}
		}elseif($this->step === 2 or $this->step === 3){ // two sides, side edges trimmed, with top and bottom edges (YZ')
			$this->temporalVector->y++; // increment through Y

			if($this->temporalVector->y > $this->maxY){ // Y loop completed
				$this->temporalVector->y = $this->minY; // reset Y for looping
				$this->temporalVector->z++; // increment through Z

				if($this->temporalVector->z >= $this->maxZ){ // Z' loop completed. Note that it is >= not > because it is Z' not Z
					if(($this->step++) === 2){ // change to the other side across X
						$this->temporalVector->z = $this->minZ + 1; // reset Z' for looping
						$this->temporalVector->x = $this->maxX; // the X component jumps to the other side
					}else{ // adapt to step 4
//						$this->temporalVector->y = $this->minY; // same, coincidentally already run
						$this->temporalVector->x = $this->minX + 1; // reset X' of X'Z' for looping
						$this->temporalVector->z = $this->minZ + 1; // reset Z' of X'Z' for looping
					}
				}
			}
		}else{ // floor and ceiling, all edges trimmed (X'Z')
			$this->temporalVector->x++;

			if($this->temporalVector->x >= $this->maxX){ // X' loop completed
				$this->temporalVector->x = $this->minX + 1; // reset X' for looping
				$this->temporalVector->z++; // increment Z'

				if($this->temporalVector->z >= $this->maxZ){
					if(($this->step++) === 4){ // change to the top side of Y
						$this->temporalVector->z = $this->minZ + 1; // reset Z' for looping
						$this->temporalVector->y = $this->maxY; // the Y component jumps to the top
					}else{ // invalidate
						$this->valid = false;
					}
				}
			}
		}

		return $return;
	}
}
