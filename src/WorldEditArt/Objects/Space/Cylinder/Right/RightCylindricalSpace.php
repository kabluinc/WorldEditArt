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

namespace WorldEditArt\Objects\Space\Cylinder\Right;

use pocketmine\level\Position;
use pocketmine\math\Vector3;
use WorldEditArt\Objects\BlockStream\BlockStream;
use WorldEditArt\Objects\Space\Space;

class RightCylindricalSpace extends Space{
	const DIRECTION_X = 0;
	const DIRECTION_Y = 1;
	const DIRECTION_Z = 2;

	/** @var Vector3 */
	private $center;
	/** @var float */
	private $radius;
	/** @var float $height */
	private $height;

	public function __construct(Position $center, float $radius = -1.0, float $height = -1.0, int $direction = self::DIRECTION_Y){
		parent::__construct($center->getLevel());
		$this->center = $center->floor();
		if($radius !== -1.0){
			$this->radius = $radius;
		}
		if($height !== -1.0){
			$this->height = $height;
		}
	}

	public function getSolidBlockStream() : BlockStream{
		// TODO: Implement getSolidBlockStream() method.
	}

	/**
	 * @param int $padding the thickness inside, default 1
	 * @param int $margin  the thickness outside, default 0
	 *
	 * @return BlockStream
	 */
	public function getHollowBlockStream(int $padding = 1, int $margin = 0) : BlockStream{
		// TODO: Implement getHollowBlockStream() method.
	}

	public function getApproxBlockCount() : int{
		// TODO: Implement getApproxBlockCount() method.
	}

	protected function isInsideImpl(Vector3 $pos) : bool{

	}
}
