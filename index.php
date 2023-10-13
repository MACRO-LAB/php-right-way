“Вы находитесь на главной странице”
<?php
$dir = "app/task_1"; // путь к папке с файлами
foreach (glob($dir. "/*.php") as $filename) {
	require_once $filename;}
