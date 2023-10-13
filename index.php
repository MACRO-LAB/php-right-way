<?php
declare(strict_types = 1);
print "Вы находитесь на главной странице";
$dir = "app/task_1"; // путь к папке с файлами
foreach (glob($dir. "/*.php") as $filename) {
	require_once $filename;}
