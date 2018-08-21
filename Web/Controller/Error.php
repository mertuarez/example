<?php
APP || die();

class Web_Controller_Error extends Sys_Controller_Default
{

    public function IndexAction(Exception $e=null) 
    {
        return $this->View("index", $e);
    }
}