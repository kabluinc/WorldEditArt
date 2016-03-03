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

use WorldEditArt\WorldEditArt;

class ProgressiveTask extends WorldEditArtTask{
	/** @var callable $job */
	private $job;
	/** @var float $threshold */
	private $threshold;

	public function __construct(WorldEditArt $main, BulkJob $job, float $threshold){
		parent::__construct($main);
		$this->job = $job;
		$this->threshold = $threshold;
	}

	public function onRun($currentTick){
		$start = microtime(true);
		while(microtime(true) - $start < $this->threshold and $this->job->hasMore()){
			$this->job->doOnce();
		}
	}
}
