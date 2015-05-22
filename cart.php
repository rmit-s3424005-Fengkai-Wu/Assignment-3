<?php /*session_start(); 
require_once 'parts/class/session_struct.php';
$json = new Session_struct();
$json->cart = new SS_Cart();

$_SESSION=$json;/**/
?>
<?php 
	require_once 'parts/page_template.php';
    $view = new Page_template();
    $view->render();
?>