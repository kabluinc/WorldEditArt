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

namespace WorldEditArt\Command;

use WorldEditArt\User\WorldEditArtUser;
use WorldEditArt\WorldEditArt;

abstract class SubCommand{
	/** @type WorldEditArt */
	private $main;

	public function __construct(WorldEditArt $main){
		$this->main = $main;
	}

	public function getMain() : WorldEditArt{
		return $this->main;
	}

	public abstract function getName() : string;

	public function getAliases() : array{
		return [];
	}

	public function run(WorldEditArtUser $user, string ...$args){
		// TODO
		return null;
	}
}
