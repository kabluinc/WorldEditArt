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

namespace WorldEditArt\Utils;

use pocketmine\scheduler\PluginTask;
use WorldEditArt\WorldEditArt;

abstract class WorldEditArtTask extends PluginTask{
	public function __construct(WorldEditArt $plugin){
		parent::__construct($plugin);
	}

	public function getMain() : WorldEditArt{
		return $this->owner;
	}
}
