<?php
echo '</br>' . '_____________1 задание' . '</br>';
function evenNumber(int $x) : int
{
	if ($x % 2 == 0)
	{
		echo 'Число x чётное';
	}
	else
	{
		echo 'Число x нечётное';
	}
	return $x;
}
evenNumber(21);