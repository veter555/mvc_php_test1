<?php
define("ROOT", getcwd());
define("BP",substr(ROOT, strlen($_SERVER['DOCUMENT_ROOT'])));
define("DS", DIRECTORY_SEPARATOR);
include ROOT . '\app\bootstrap.php';
