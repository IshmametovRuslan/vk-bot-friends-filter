<?php
/**
 * Created by PhpStorm.
 * User: таня
 * Date: 17.02.2018
 * Time: 19:35
 */
error_reporting(E_ALL & ~E_NOTICE);
$users = array(
	'count' => 4,
	'items' => array(

		0 => array(
			'name'   => 'ivan',
			'gender' => '2',
			'age'    => '21'
		),
		1 => array(
			'name'   => 'sveta',
			'gender' => '1',
			'age'    => '30'
		),
		2 => array(
			'name'   => 'kiril',
			'gender' => '2',
			'age'    => '32'
		),
		3 => array(
			'name'   => 'olya',
			'gender' => '1',
			'age'    => '22'
		)
	)
);

function eval_five( $users ) {
	global $us;
	$us = [];
	if ( is_array( $users ) ) {
		foreach ( $users as $key ) {
			return $key;
		}
		for ($i = 0; $i <= $users['count']; $i++){
			$us[] = $key[$i];
		}
	}
	return $us;
}
global $us;
eval_five( $users );
echo '<pre>';
print_r($us);
echo '</pre>';