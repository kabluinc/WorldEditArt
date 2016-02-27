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

class BlockBuffer{
	/** @var BlockStream $stream */
	private $stream;

	/** @var int $pointer */
	private $pointer = 0;
	/** @var Block[] $buffer */
	private $buffer;

	public function __construct(BlockStream $stream){
		$this->stream = $stream;
	}

	/**
	 * @return Block|null
	 */
	public function next(){
		if(!isset($this->buffer[$this->pointer])){
			$block = $this->stream->next();
			if($block === null){
				return null;
			}
			$this->buffer[$this->pointer] = $block;
		}
		return $this->buffer[$this->pointer++];
	}
}
