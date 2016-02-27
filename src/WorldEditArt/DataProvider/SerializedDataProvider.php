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

namespace WorldEditArt\DataProvider;

use WorldEditArt\DataProvider\Model\UserData;
use WorldEditArt\WorldEditArt;

class SerializedDataProvider implements DataProvider{
	/** @var WorldEditArt $main */
	private $main;
	/** @var string $path */
	private $path;

	public function __construct(WorldEditArt $main){
		$this->main = $main;
		$this->path = $main->getDataFolder() . "users/";
		mkdir($this->path);
	}

	public function getUserData(string $type, string $name) : UserData{
		$data = new UserData($type, $name);
		if(is_file($file = $this->path . $type . "/" . $name . ".json")){
			$json = json_decode(file_get_contents($file), true);
			$data->langs = $json["langs"];
			$data->itemActions = $json["itemActions"];
		}
		return $data;
	}

	public function saveUserData(UserData $data){
		if(!is_dir($dir = $this->path . $data->type)){
			mkdir($dir);
		}
		file_put_contents($this->path . $data->type . "/" . $data->name . ".json", json_encode([
			"type" => $data->type,
			"name" => $data->name,
			"itemActions" => $data->itemActions,
			"langs" => $data->langs,
		], JSON_PRETTY_PRINT | JSON_BIGINT_AS_STRING | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
	}
}
