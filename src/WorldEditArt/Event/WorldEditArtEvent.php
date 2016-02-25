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

namespace WorldEditArt\Event;

use pocketmine\event\plugin\PluginEvent;
use WorldEditArt\WorldEditArt;

abstract class WorldEditArtEvent extends PluginEvent{
	public function __construct(WorldEditArt $plugin){
		parent::__construct($plugin);
	}

	/**
	 * @return WorldEditArt
	 */
	public function getPlugin(){
		return parent::getPlugin();
	}
}
