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

namespace WorldEditArt\Lang;

class Translation{
	/** @type string */
	private $id, $value;
	/** @type string */
	private $since, $updated;

	public function __construct(string $id, string $value, string $since, string $updated){
		$this->id = $id;
		$this->value = $value;
		$this->since = $since;
		$this->updated = $updated;
	}

	public function getValue() : string{
		return $this->value;
	}

	public function getSince() : string{
		return $this->since;
	}

	public function getUpdated() : string{
		return $this->updated;
	}
}
