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

namespace WorldEditArt\User;

use WorldEditArt\Objects\BlockStream\Cassette;
use WorldEditArt\Utils\BulkJob;

class CassetteQueue implements BulkJob{
	const DIRECTION_FORWARDS = false;
	const DIRECTION_BACKWARDS = true;

	/** @var WorldEditArtUser */
	private $user;

	/** @var bool $currentDirection */
	private $currentDirection = self::DIRECTION_FORWARDS;
	/** @var int $undoCounter */
	private $undoCounter = 0;

	/** @var Cassette[] $undoQueue */
	private $undoQueue = [];
	/** @var Cassette[] $execQueue */
	private $execQueue = [];
	/** @var Cassette[] $redoQueue */
	private $redoQueue = [];

	public function __construct(WorldEditArtUser $user){
		$this->user = $user;
	}

	public function insert(Cassette $cassette){
		$this->redoQueue = [];
		$this->execQueue[] = $cassette;
	}

	public function undo(){

	}

	public function redo(){

	}

	public function doOnce(){
		$this->execQueue[0]->tick();
		if($this->execQueue[0]->)
	}

	public function hasMore() : bool{
		return !$this->user->isClosed();
	}
}
