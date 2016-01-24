<?php
// include as if there was no tomorrow!!
foreach (glob("Utility/*.php") as $filename){
    include_once $filename;
}
//include_once 'Utility/connector.php';
foreach (glob("Model/*.php") as $filename){
    include_once $filename;
}
//print_r($_SERVER);
$controller_path = 'REST_Controller/';
$requestMethod = $_SERVER['REQUEST_METHOD'];
//$scheme = $_REQUEST['REQUEST_SCHEME'];
$method = $_GET['method'];
$time = $_SERVER['REQUEST_TIME'];

//CREO IL GESTORE DEGLI URL
// /?method="login"
$URL = array(
       array('login','doLogin'), 
       array('logout', 'doLogout'),
       array ('createproject','createProject')
);
header('Content-Type: application/json');
//echo $requestMethod . $method;
//CONTROLLO CHE L'URL SIA ESISTENTE ALTRIMENTI LANCIO 404
foreach ($URL as list($url, $func)){
    if($method == $url){
        //echo $controller_path.$func .'.php';
        include_once $controller_path . $func . '.php';
        
    }
}