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

namespace WorldEditArt\Utils;

class BulkJobManager implements BulkJob{
	/** @var BulkJob[] $jobs */
	private $jobs = [];
	private $pointer = 0;

	public function doOnce(){
		$job = $this->jobs[$this->pointer];
		if($job->hasMore()){
			$job->doOnce();
			$this->pointer++;
		}else{
			array_splice($this->jobs, $this->pointer, 1);
		}
		if($this->pointer !== 0 and !isset($this->jobs[$this->pointer])){
			$this->pointer = 0;
		}
	}

	public function hasMore() : bool{
		return count($this->jobs) > 0;
	}

	public function add(BulkJob $bulkJob){
		$this->jobs[] = $bulkJob;
	}
}
