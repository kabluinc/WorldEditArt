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

class GeneralUtils{
	public static function valueForMaxKeyInArray(array $array, $defaultValue = null){
		$maxKey = PHP_INT_MIN;
		$currentValue = $defaultValue;
		foreach($array as $key => $value){
			if(!is_int($key)){
				throw new \InvalidArgumentException("Only numeric offsets are allowed");
			}
			if($key >= $maxKey){
				$currentValue = $value;
				$maxKey = $key;
			}
		}
		return $currentValue;
	}
}
