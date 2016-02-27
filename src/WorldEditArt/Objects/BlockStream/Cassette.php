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

class Cassette{
	/** @var BlockBuffer $buffer */
	private $buffer;
	/** @var BlockChanger $changer */
	private $changer;

	public function __construct(BlockBuffer $buffer, BlockChanger $changer){
		$this->buffer = $buffer;
		$this->changer = $changer;
	}

	public function tick(){
	}
}
