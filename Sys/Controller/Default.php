<?php
APP || die();

class Sys_Controller_Default 
{
    /** @var Sys_Db_Mapper **/
    protected $mapper;

    public function __construct($mapper=null)
    {
        $this->mapper = $mapper;
    }

    public function View($name,$viewData=null)
    {
        $route = explode("_",get_class($this));
        $layoutPath = "../View/_Shared/Layout.php";
        $viewPath = "../View/".$route[2]."/".ucfirst($name).".php";

        if (file_exists($viewPath))
        {
            include_once($layoutPath);
        }
        else
        {
            throw new Exception("missing view");
        }
    }

    public function __call($method,$args)
    {
        throw new Exception("missing action");
    }

}