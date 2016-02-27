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

namespace WorldEditArt;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use WorldEditArt\User\PlayerUser;

class EventListener implements Listener{
	/** @var WorldEditArt $main */
	private $main;

	public function __construct(WorldEditArt $main){
		$this->main = $main;
	}

	public function e_join(PlayerJoinEvent $event){
		$data = $this->main->getDataProvider()->getUserData(PlayerUser::TYPE_NAME, strtolower($event->getPlayer()->getName()));
		$user = new PlayerUser($this->main, $event->getPlayer(), $data);
		$this->main->addUser($user);
	}

	public function e_quit(PlayerQuitEvent $event){
		$user = $this->main->getUser($event->getPlayer());
		if($user !== null){
			$this->main->endUser($user);
		}
	}
}
