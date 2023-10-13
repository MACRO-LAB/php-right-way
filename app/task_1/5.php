<?php
//declare(strict_types = 1);
echo '</br>' . '_____________5 задание' . '</br>';

$arr5 = [
	'error-control' => '@',

	'assignment' => '= += -= *= /= %= **=',
	'string' => '. .=',
	'comparison' => '== === != !== <> <= >= ?? ?:',
	'logical' => 'or || && and !',
	'in/de-crement' => '-- ++',
	'bitwise' => '~ ^ & | << >>',
	'array' => '+ == === != <> !==',
	'execution' => '``',
	'type' => 'instanceof',
	'nullsafe' => '?',
	'arithmetic' => '+ - / % **',
];

function search($x)
{
	$arr = [
		'error-control' => '@',
		'arithmetic' => '+ - / % **',
		'assignment' => '= += -= *= /= %= **=',
		'string' => '. .=',
		'comparison' => '== === != !== <> <= >= ?? ?:',
		'logical' => 'or || && and !',
		'in/de-crement' => '-- ++',
		'bitwise' => '~ ^ & | << >>',
		'array' => '+ == === != <> !==',
		'execution' => '``',
		'type' => 'instanceof',
		'nullsafe' => '?',

	];
	foreach ($arr as $key => $item)
	{
		$pp = explode(' ', $item);
		if (in_array($x, $pp))
		{
			echo "Оператор '$x' относится к операторам $key. </br>";
		}
	}
}
search('+');