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

namespace WorldEditArt\Objects\Space\Sphere\Ellipse;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use WorldEditArt\Objects\BlockStream\CuboidBlockStream;

class SolidEllipsoidBlockStream extends CuboidBlockStream{
	/** @var EllipsoidSpace $space */
	private $space;

	public function __construct(EllipsoidSpace $space){
		$center = $space->getCenter();
		$maxDiff = new Vector3($space->getXRadius(), $space->getYRadius(), $space->getZRadius());
		parent::__construct($space->getLevel(), $center->subtract($maxDiff), $center->add($maxDiff));
	}

	public function accept(Block $block) : bool{
		return $this->space->isInside($block);
	}
}
