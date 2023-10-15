<?php
require_once '6_data.php';
/**
 *  @var array $allData
 */


/**
 * @return ID
 */
function getId()
{
	static $id = 0;
	$id++;
	return $id;
};

/**
 * @return переводит символы с кириллицы на латиницу
 */
function toLat($text) {
	$converter = array(
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => '', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'h', 'щ' => 'ch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
	);
	return strtr($text, $converter);
}
function randGender(){
	global $allData;
	$randGender = array_rand($allData['gender']);
	return $randGender;
}
function generateMail()
{
	global $allData;
	$randGender =randGender();
	$countLastNAme = rand(0, (count($allData['lastName']) - 1));
	$latName='';
	$latLastName ='';
	if ($randGender == 'male')
	{
		$countGender = rand(0, (count($allData['gender']['male']) - 1));
		$latName = toLat($allData['gender']['male'][$countGender]);
		$latLastName = toLat($allData['lastName'][$countLastNAme]);
	}elseif ($randGender == 'female'){
		$countGender = rand(0, (count($allData['gender']['female']) - 1));
		$latName = toLat($allData['gender']['female'][$countGender]);
		$latLastName = toLat($allData['lastName'][$countLastNAme]) . 'a';
	}
	$countDom = rand(0, (count($allData['domains']) - 1));
	$domain = $allData['domains'][$countDom];
	return strtolower($latName . $latLastName . '@' . $domain);
}
function birthday($max=1104537600, $min=0){
	$randTime = rand(0,1104537600);
	return date('d.m.Y', $randTime);

}
function createUsers($size) {

	$main = [
		'id' => '',
		'gender' => '',
		'name' => '',
		'last_name' => '',
		'mail' => '',
		'birthday' => '',
		'position_id' => '',
		'position' => '',
		'alary' => '',
		'age' => '',
	];
	$main['id']=getId();
	$main['gender']=randGender();
	$main['name'] ='';
	$main['last_name'] ='';
	$main['birthday'] = birthday();
	$main['mail'] = generateMail();
	echo "<pre>";
	$mainEx=array_slice($main,0,$size);
	print_r($mainEx);
	echo "</br>";

}
createUsers(14);




