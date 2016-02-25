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

namespace WorldEditArt\DataProvider\Model;

use pocketmine\item\Item;

class UserData{
	const ACTION_NONE = 0;

	public $name;

	/** @type int[] */
	public $itemActions;

	public function mapForItem(Item $item) : int{
		return $this->itemActions[$item->getId() . ":" . $item->getDamage()] ?? self::ACTION_NONE;
	}
}
