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

use pocketmine\level\Location;
use pocketmine\level\Position;
use pocketmine\permission\Permissible;
use WorldEditArt\DataProvider\Model\UserData;
use WorldEditArt\Objects\Space\Space;
use WorldEditArt\WorldEditArt;

abstract class WorldEditArtUser implements Permissible{
	/** @var WorldEditArt $main */
	private $main;
	/** @var UserData $data */
	private $data;

	/** @var Space[] $selections */
	private $selections = [];

	/** @var bool $closed */
	private $closed = false;

	public function __construct(WorldEditArt $main, UserData $data){
		$this->main = $main;
		$this->data = $data;
	}

	public abstract function getType() : string;

	public abstract function getName() : string;

	public abstract function sendRawMessage(string $message);

	public abstract function getLocation() : Location;

	public function getUniqueName() : string{
		return $this->getType() . "/" . $this->getName();
	}

	public function getLangs() : array{
		return $this->data->langs;
	}

	public function getData() : UserData{
		return $this->data;
	}

	public function translate(string $id, array $vars = []){
		return $this->main->translate($id, $this->getLangs(), $vars);
	}

	public function sendMessage(string $id, array $vars = []){
		$this->sendRawMessage((substr($id, 0, 5) === "%raw%") ? $id : $this->main->translate($id, $vars));
	}

	public function save(){
		$this->main->getDataProvider()->saveUserData($this->data);
	}

	public function isClosed() : bool{
		return $this->closed;
	}

	public function close(){
		$this->save();
		$this->closed = true;
	}

	/**
	 * @param string $name
	 * @return Space|null
	 */
	public function getSelection(string $name = "default"){
		return $this->selections[$name] ?? null;
	}

	public function setSelection(Space $space, string $name = "default"){

	}

	public function canBuild(Position $pos) : bool{
		return true; // TODO under-construction zones
	}
}
