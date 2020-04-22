<?php

function convertChars($char){
	
	if ($char == "a"){
		$ch = 2345;
	} elseif ($char == "b"){
		$ch = 7535;
	} elseif ($char == "c"){
		$ch = 0263;
	} elseif ($char == "d"){
		$ch = 3578;
	} elseif ($char == "e"){
		$ch = 2745;
	} elseif ($char == "f"){
		$ch = 2178;
	} elseif ($char == "g"){
		$ch = 4788;
	} elseif ($char == "h"){
		$ch = 1314;
	} elseif ($char == "i"){
		$ch = 1333;
	} elseif ($char == "j"){
		$ch = 1337;
	} elseif ($char == "k"){
		$ch = 8646;
	} elseif ($char == "l"){
		$ch = 5457;
	} elseif ($char == "m"){
		$ch = 7545;
	} elseif ($char == "n"){
		$ch = 5238;
	} elseif ($char == "o"){
		$ch = 6568;
	} elseif ($char == "p"){
		$ch = 7296;
	} elseif ($char == "q"){
		$ch = 1247;
	} elseif ($char == "r"){
		$ch = 7825;
	} elseif ($char == "s"){
		$ch = 7456;
	} elseif ($char == "t"){
		$ch = 1327;
	} elseif ($char == "u"){
		$ch = 4574;
	} elseif ($char == "v"){
		$ch = 8253;
	} elseif ($char == "w"){
		$ch = 1727;
	} elseif ($char == "x"){
		$ch = 0795;
	} elseif ($char == "y"){
		$ch = 5235;
	} elseif ($char == "z"){
		$ch = 1462;
	} elseif ($char == "0"){
		$ch = 4135;
	} elseif ($char == "1"){
		$ch = 4365;
	} elseif ($char == "2"){
		$ch = 9775;
	} elseif ($char == "3"){
		$ch = 1020;
	} elseif ($char == "4"){
		$ch = 9964;
	} elseif ($char == "5"){
		$ch = 8748;
	} elseif ($char == "6"){
		$ch = 8795;
	} elseif ($char == "7"){
		$ch = 7124;
	} elseif ($char == "8"){
		$ch = 6457;
	} elseif ($char == "9"){
		$ch = 9467;
	} else {
		$ch = 5454;
	}
	
	return $ch;
	
}

function bhfrm($string){
	
	$newString1 = null;
	$newPass = null;
	$multiplier = null;
	$nextPass = null;
	$finalPass = null;
	
	for ($i=0; $i < strlen($string); $i++)
	{
		
		$chars[] = $string[$i];
		$newString1 .= convertChars($chars[$i]);
		
	}
	
	// make a large num
	$newPass = $newString1 * 1000000;
	
	// divide string to smaller num (dynamic on characters)
	$multiplier = $i * 50;
	$nextPass = $newPass / $multiplier;
	
	$finalPass = md5($nextPass);
	
	return $finalPass;
	
}

?>