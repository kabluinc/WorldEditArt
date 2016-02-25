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
 * @author LegendsOfMCPE Team
 */

namespace WorldEditArt\User;

use pocketmine\Player;

class PlayerUser extends WorldEditArtUser{
	/** @type Player */
	private $player;

	public function __construct(Player $player){
		$this->player = $player;
	}

	public function getType() : string{
		return "WorldEditArt.User";
	}

	public function getName() : string{
		return strtolower($this->player->getName());
	}
}
