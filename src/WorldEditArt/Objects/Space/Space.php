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

namespace WorldEditArt\Objects\Space;

use pocketmine\level\Level;
use WorldEditArt\Objects\BlockStream\BlockBuffer;

abstract class Space{
	/** @var Level $level */
	private $level;

	protected function __construct(Level $level){
		$this->level = $level;
	}

	public function getLevel(){
		return $this->level;
	}

	public abstract function getSolidBuffer() : BlockBuffer;

	public abstract function getHollowBuffer() : BlockBuffer;

	public abstract function getApproxBlockCount() : int;
}
