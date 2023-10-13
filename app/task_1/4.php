<?php
echo '</br>' . '_____________4 задание' . '</br>';
$x = 200;
$path = $_SERVER['DOCUMENT_ROOT'];
switch ($x)
{
	case '200':
		require $path . "/index.php";
		break;
	case '404':
		require $path . "/404.php";
		break;
}

match ("$x"){
	'200'=>require $path . "/index.php",
	'404'=>require $path . "/404.php",
};
