<?php
echo '</br>' . '_____________3.1 задание' . '</br>';

$array = [23, 3, 5, 1, 6, 34, 100, 10, 45, 5, 0];
function bubbleSort($arr)
{
	$n = count($arr);
	$i = 0;
	while ($i <= $n)
	{
		for ($j = 0; $j < $n - $i - 1; $j++)
		{
			if ($arr[$j] > $arr[$j + 1])
			{
				$temp = $arr[$j];
				$arr[$j] = $arr[$j + 1];
				$arr[$j + 1] = $temp;
			}
		}
		$i++;
	}
	return $arr;
}

var_dump(bubbleSort($array));
echo '</br>';

function summVar($x)
{
	if (strlen($x[0]) > 1)
	{
		$z = "$x[0]";
		echo($z[0] + $z[1]);
	};
}

summVar($array);

echo '</br>' . '_____________3.2 задание' . '</br>';

foreach ($array as $arr)
{
	$summStr = strlen($arr);
	if ($summStr > 1)
	{
		$arrSTR = strval($arr);
		$summ = 0;
		for ($i = 0; $i < $summStr; $i++)
		{
			$summ += $arrSTR[$i];
		}
		echo $summ . '</br>';
	}
}
