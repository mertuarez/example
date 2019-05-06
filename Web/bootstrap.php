<?php
APP || die();

$db_host = "localhost";
$db_port = 3306;
$db_base = "example";
$db_user = "exampleuser";
$db_pass = "password";

$url_prefix = "/example";
chdir("../..");
// phpinfo();

#date_default_timezone_set('Europe/Bratislava');
#$loc=setlocale(LC_ALL, 'sk_SK@euro', 'sk_SK', 'svk_svk');

spl_autoload_register(function ($class) {

    $classpath = str_replace("_","/",$class).".php";
    
    if (file_exists($classpath))
    {
        include_once($classpath);
    }
    else
    {
        throw new Exception("missing file: ".$classpath);
    }
        
});


try
{
    $route = explode('?',substr($_SERVER["REQUEST_URI"], strlen($url_prefix)))[0].'/';

    $mapper = new Sys_Db_Mapper($db_user,$db_pass,$db_base,$db_host,$db_port);
    $controller = null;
    $view = null;
    
    //Routing
    if (strpos($route, '/user/') === 0)
    {
        $controller = new Web_Controller_User_Index($mapper);
        $view = "Web/View/User/Index.php";    
    }
    else if (strpos($route, '/error/') === 0)
    {
        $controller = new Web_Controller_Error_Index($mapper);
        $view = "Web/View/Error/Index.php";
    }
    else
    {
        $controller = new Web_Controller_Home_Index($mapper);
        $view = "Web/View/Home/Index.php";
    }
    
    // Do Post or Get
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $viewData = $controller->Post(null);
    }
    else
    {
        $viewData = $controller->Get(null);
    }
    
    //Render View
    include_once "Web/View/_Shared/Layout.php";
} 
catch (Exception $e)
{
    //Fallback
    $controller = new Web_Controller_Error_Index(null);
    $viewData = $controller->Get($e);
    include_once "Web/View/Home/Index.php";
}