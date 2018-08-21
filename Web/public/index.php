<?php
define("APP",true);
define("APP_ENV", $_SERVER["APP_ENV"]);

include_once("../Config.php");

#date_default_timezone_set('Europe/Bratislava');
#$loc=setlocale(LC_ALL, 'sk_SK@euro', 'sk_SK', 'svk_svk');

spl_autoload_register(function ($class) {

    $classpath = "../../".str_replace("_","/",$class).".php";
    
    if (file_exists($classpath))
    {
        include_once($classpath);
    }
    else
    {
        throw new Exception("missing file");
    }
        
});

$route = explode("/",$_SERVER["PATH_INFO"]);

if (count($route)<2 || $route[1]=="")
{
    $route[1] = "Home";
}

if (count($route)<3 || $route[2]=="")
{
    $route[2] = "Index";
}

for($i=0;$i<count($route);$i++)
{
    $route[$i] = str_replace(".","",$route[$i]);
    $route[$i] = str_replace("\\","",$route[$i]);
    $route[$i] = str_replace("_","",$route[$i]);
}

$controllerName = "Web_Controller_" . ucfirst($route[1]);
$controllerActionName = ucfirst($route[2]) . "Action";

try
{
    $mapper = new Sys_Db_Mapper($db_user,$db_pass,$db_base,$db_host,$db_port);
    $controller = new $controllerName($mapper);
    $controller->$controllerActionName();
}
catch(Exception $e)
{
    $controller = new Web_Controller_Error();
    $controller->IndexAction($e);
}

