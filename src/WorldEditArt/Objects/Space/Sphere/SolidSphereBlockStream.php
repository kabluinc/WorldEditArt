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

namespace WorldEditArt\Objects\Space\Sphere;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use WorldEditArt\Objects\BlockStream\CuboidBlockStream;

class SolidSphereBlockStream extends CuboidBlockStream{
	/** @var Vector3 $center */
	protected $center;
	/** @var float $radiusSquared */
	private $radiusSquared;

	public function __construct(SphereSpace $sphere){
		$sphere->throwValid();
		$this->center = $sphere->getCenter();
		$radius = $sphere->getRadius();
		$this->radiusSquared = $radius ** 2;
		parent::__construct($sphere->getLevel(), $this->center->subtract($radius, $radius, $radius), $this->center->add($radius, $radius, $radius));
	}

	protected function accept(Block $block) : bool{
		return $block->distanceSquared($this->center) <= $this->radiusSquared;
	}
}
