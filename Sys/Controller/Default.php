<?php
APP || die();

abstract class Sys_Controller_Default 
{
    /** @var Sys_Db_Mapper **/
    protected $mapper;

    public function __construct($mapper=null)
    {
        $this->mapper = $mapper;
    }

    public abstract function Get($param);

    public abstract function Post($param);

}