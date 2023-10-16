<?php
//require_once '6_data.php';
$allData = [
	'id' => [],
	'gender' => [
		'male' => ['Александр', 'Фёдор', 'Савелий', 'Максим', 'Виктор', 'Кирилл'],
		'female' => ['Мария', 'Анна', 'Александра', 'Юлия'],
	],
	'lastName' => [
		'Иванов',
		'Дегтярев',
		'Жиленков',
		'Тимофеев',
		'Турин',
		'Комаров',
		'Панищев',
	],
	'domains' => ['gmail.com', 'yandex.ru', 'mail.ru'],
	'position_id' => [
		0 => [
			'position' => 'junior',
			'salary' => [
				'fixed_part' => 50000,
				'bonuses' => [
					0 => 5000,
					1 => 3000,
					2 => 550,
					3 => 450,
				],
			],
		],
		1 => [
			'position' => 'middle',
			'salary' => [
				'fixed_part' => 70000,
				'bonuses' => [
					0 => 8000,
					1 => 5000,
					2 => 750,
					3 => 1650,
					4 => 1000,
				],
			],
		],
		2 => [
			'position' => 'senior',
			'salary' => [
				'fixed_part' => 90000,
				'bonuses' => [
					0 => 10000,
					1 => 1000,
					2 => 500,
					3 => 2000,
					4 => 1500,
					5 => 6000,
				],
			],
		],
	],
];
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
/**
sort age
 */
function sortArrayAge($a, $b)
{
	return $a['age']-$b['age'];
}

/**
sort lastname
 */
function sortArrayLastName($a, $b) {

	return strcmp($a['last_name'], $b['last_name']);
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
$user4 = createUsers(10);
$user5 = createUsers(10);
array_push($arr1, $user1, $user2, $user3, $user4, $user5);


usort($arr1, 'sortArrayAge');
echo 'sort age';
print_r($arr1);

usort($arr1, 'sortArrayLastName');
echo 'sort lastname';
print_r($arr1);


//function filterArr($a,$b)
//{
//	//	return strlen($a['last_name'])-strlen($b['last_name']);
//	$x = strcmp($a['last_name'],$b['last_name']);
//	if ($x ==1)
//	{
//		return $a['last_name'];
//	}
//}
//
//$x = array_filter($arr1,'filterArr');
//print_r($x);










