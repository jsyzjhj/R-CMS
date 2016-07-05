<?php 

$_GET['m'] = (!isset($_GET['m']) || !$_GET['m'])?'home':$_GET['m'];
$_GET['c'] = (!isset($_GET['c']) || !$_GET['c'])?'index':$_GET['c'];
$_GET['a'] = (!isset($_GET['a']) || !$_GET['a'])?'index':$_GET['a'];

define('APP_NAME', 'R-CMS');
define('APP_PATH', './R-CMS/');
define('APP_DEBUG', true);

require_once('./ThinkPHP/ThinkPHP.php');

 ?>