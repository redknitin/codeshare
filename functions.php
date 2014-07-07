<?php
/*
Copyright (C) K.N.Reddy 2012
All Rights Reserved
*/
?><?php
function is_name_restricted($a_name) {
	$restricted_arr = array(
		'Nitin Reddy',
		'Katkam',
		'KNReddy',
		'K.N.Reddy',
		'K.N. Reddy',
		'K. N. Reddy',
		'K N Reddy',
		'KN Reddy',
	);
	
	for($restricted_arr as $iter) {
		if(strstr(strtolower($a_name), strtolower($iter))) {
			return true;
		}
	}
	
	return false;
}
?>