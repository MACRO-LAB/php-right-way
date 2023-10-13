<?php
echo '</br>' . '_____________5 задание' . '</br>';
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
		if (in_array($x, $pp,true))
		{
			echo "Оператор '$x' относится к операторам $key. </br>";
		}
	}
}
search('+');