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
	const DAMAGE_ANY = -1;

	const CLICK_METHOD_ANY = -1;
	const CLICK_METHOD_LEFT = 1;
	const CLICK_METHOD_RIGHT = 2;

	const ACTION_NONE = 0;
	const ACTION_SELECT_CUBOID_1 = 1;
	const ACTION_SELECT_CUBOID_2 = 2;
	const ACTION_SELECT_SPHERE_CENTER = 3;
	const ACTION_SELECT_SPHERE_RADIUS = 4;
	const ACTION_SELECT_CYLINDER_CENTER = 5;
	const ACTION_SELECT_CYLINDER_RADIUS = 6;
	const ACTION_SELECT_CYLINDER_HEIGHT = 7;

	/** @var string $type */
	public $type;
	/** @var string $name */
	public $name;

	/** @var int[] $itemActions */
	public $itemActions = [];

	/** @var string[] $langs */
	public $langs = [];

	public function __construct(string $type, string $name){
		$this->type = $type;
		$this->name = $name;
	}

	public function getItemAction(Item $item, int $clickMethod) : int{
		$id = $item->getId();
		$damage = $item->getDamage();
		$anyDamage = self::DAMAGE_ANY;
		$anyClickMethod = self::CLICK_METHOD_ANY;
		return (
			$this->itemActions["$id:$damage:$clickMethod"]??
			$this->itemActions["$id:$anyDamage:$clickMethod"] ??
			$this->itemActions["$id:$damage:$anyClickMethod"] ??
			$this->itemActions["$id:$anyDamage:$anyClickMethod"] ??
			self::ACTION_NONE
		);
	}

	public function setItemAction(Item $item, int $clickMethod, int $action, bool $damageSensitive = false){
		$this->itemActions[$item->getId() . ":" . ($damageSensitive ? $item->getDamage() : self::DAMAGE_ANY) . ":" . $clickMethod] = $action;
	}
}
