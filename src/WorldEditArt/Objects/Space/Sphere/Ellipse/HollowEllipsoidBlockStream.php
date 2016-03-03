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
use WorldEditArt\Objects\BlockStream\CuboidBlockStream;

class HollowEllipsoidBlockStream extends CuboidBlockStream{
	/** @var EllipsoidSpace $space */
	private $space;
	/** @var float $padX2 */
	private $padX2;
	/** @var float $padY2 */
	private $padY2;
	/** @var float $padZ2 */
	private $padZ2;
	/** @var float $marX2 */
	private $marX2;
	/** @var float $marY2 */
	private $marY2;
	/** @var float $marZ2 */
	private $marZ2;

	public function __construct(EllipsoidSpace $space, int $padding = 1, $margin = 0){
		$this->marX2 = ($dx = $space->getXRadius() + $margin) ** 2;
		$this->marY2 = ($dy = $space->getYRadius() + $margin) ** 2;
		$this->marZ2 = ($dz = $space->getZRadius() + $margin) ** 2;
		$this->padX2 = ($space->getXRadius() - $padding) ** 2;
		$this->padY2 = ($space->getYRadius() - $padding) ** 2;
		$this->padZ2 = ($space->getZRadius() - $padding) ** 2;
		parent::__construct($space->getLevel(), $space->getCenter()->subtract($dx, $dy, $dx), $space->getCenter()->add($dx, $dy, $dz));
	}

	public function accept(Block $block) : bool{
		$diff = $block->subtract($this->space->getCenter());
		$padded = $diff->x ** 2 / $this->padX2 + $diff->y ** 2 / $this->padY2 + $diff->z ** 2 / $this->padZ2;
		$margin = $diff->x ** 2 / $this->marX2 + $diff->y ** 2 / $this->marY2 + $diff->z ** 2 / $this->marZ2;
		return $margin <= 1 and 1 <= $padded;
	}
}
