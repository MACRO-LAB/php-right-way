<?php
require_once '6_data.php';
/**
 * @var array $allData
 */

/**
 * @return ID
 */
$id = 0;
$getId = function(&$id)
{
	$id++;
	return $id;
};

/**
 * @return переводит символы с кириллицы на латиницу
 */
function toLat($text)
{
	$converter = array(
		'а' => 'a',
		'б' => 'b',
		'в' => 'v',
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'y',
		'к' => 'k',
		'л' => 'l',
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p',
		'р' => 'r',
		'с' => '',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'h',
		'ц' => 'c',
		'ч' => 'ch',
		'ш' => 'h',
		'щ' => 'ch',
		'ъ' => '',
		'ы' => 'y',
		'ь' => '',
		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',
		'А' => 'A',
		'Б' => 'B',
		'В' => 'V',
		'Г' => 'G',
		'Д' => 'D',
		'Е' => 'E',
		'Ё' => 'E',
		'Ж' => 'Zh',
		'З' => 'Z',
		'И' => 'I',
		'Й' => 'Y',
		'К' => 'K',
		'Л' => 'L',
		'М' => 'M',
		'Н' => 'N',
		'О' => 'O',
		'П' => 'P',
		'Р' => 'R',
		'С' => 'S',
		'Т' => 'T',
		'У' => 'U',
		'Ф' => 'F',
		'Х' => 'H',
		'Ц' => 'C',
		'Ч' => 'Ch',
		'Ш' => 'Sh',
		'Щ' => 'Sch',
		'Ъ' => '',
		'Ы' => 'Y',
		'Ь' => '',
		'Э' => 'E',
		'Ю' => 'Yu',
		'Я' => 'Ya',
	);
	return strtr($text, $converter);
}

function randGender()
{
	global $allData;
	return array_rand($allData['gender']);
}

function randName($gend)
{
	global $allData;
	$name = '';
	if ($gend == 'male')
	{
		$countGender = rand(0, (count($allData['gender']['male']) - 1));
		$name = $allData['gender']['male'][$countGender];
	}
	else if ($gend == 'female')
	{
		$countGender = rand(0, (count($allData['gender']['female']) - 1));
		$name = $allData['gender']['female'][$countGender];
	}
	return $name;
}

function randLastName($gend)
{
	global $allData;
	$lastName = '';
	$countLastNAme = rand(0, (count($allData['lastName']) - 1));
	if ($gend == 'male')
	{
		$lastName = $allData['lastName'][$countLastNAme];
	}
	else if ($gend == 'female')
	{
		$lastName = $allData['lastName'][$countLastNAme] . 'a';
	}
	return $lastName;
}

function generateMail($name, $lastName)
{
	global $allData;
	$countDom = rand(0, (count($allData['domains']) - 1));
	$nameLAT = toLat($name);
	$nameLAstLAT = toLat($lastName);
	$domain = $allData['domains'][$countDom];
	return strtolower($nameLAT[0] . $nameLAstLAT . '@' . $domain);
}

function birthday($max, $min = 0)
{
	$strtotime = strtotime($max);
	$randTime = rand(0, $strtotime);
	return date('d.m.Y', $randTime);
}

function position($randPosition_id)
{
	global $allData;
	$positionArr = [];
	foreach ($allData['position_id'] as $key => $pos)
	{
		array_push($positionArr, $pos['position']);
	}
	$position = $positionArr[array_rand($positionArr)];

	return $position;
}

/**
 * @return salaryCalc ЗП сотрудника = 'fixed_part' + 'bonuses' - налог 13%
 */
function salaryCalc($position, $randPosition_id) : float
{
	global $allData;
	$fixedPart = $allData['position_id'][$randPosition_id]['salary']['fixed_part'];
	$bonusesRand = array_rand($allData['position_id'][$randPosition_id]['salary']['bonuses']);
	$bonuses = $allData['position_id'][$randPosition_id]['salary']['bonuses'][$bonusesRand];
	$salary = $fixedPart + $bonuses - ($fixedPart + $bonuses) * 0.13;
	return round($salary, 2);
}

date_default_timezone_set('UTC');
function calculateAge($birthday, $data)
{
	$age = $data - substr($birthday, -4);
	return $age;
}

function createUsers($size)
{
	global $allData;
	global $id;
	global $getId;

	$main = [
		'id' => '',
		'gender' => '',
		'name' => '',
		'last_name' => '',
		'mail' => '',
		'birthday' => '',
		'position_id' => '',
		'position' => '',
		'salary' => '',
		'age' => '',
	];
	$main['id'] = $getId($id);
	$randGender = randGender();
	$main['gender'] = $randGender;
	$main['name'] = randName($randGender);
	$main['last_name'] = randLastName($randGender);
	$main['birthday'] = birthday('1.1.2000');
	$main['mail'] = generateMail($main['name'], $main['last_name']);
	$randPosition_id = array_rand($allData['position_id']);
	$main['position_id'] = $randPosition_id;
	$main['position'] = position($randPosition_id);
	$main['salary'] = salaryCalc($main['position'], $randPosition_id);

	$main['age'] = calculateAge($main['birthday'], date('Y'));
	echo "<pre>";
	$mainEx = array_slice($main, 0, $size);
	return $mainEx;
}

echo "<pre>";
echo "</br>";
$arr1 = [];
$user1 = createUsers(14);
$user2 = createUsers(13);
$user3 = createUsers(10);
array_push($arr1, $user1, $user2, $user3);

function compareByAge($a, $b)
{
	return $a['age'] - $b['age'];
}

usort($arr1, 'compareByAge');

function compareByLastName($a, $b)
{
	return $a['lastName'] - $b['lastName'];
}

usort($arr1, 'compareByAge');

print_r($arr1);






