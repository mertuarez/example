<?php
APP || die();

class Web_Controller_Home extends Sys_Controller_Default
{

    public function IndexAction() 
    {
        return $this->View("index", "HomeData");
    }
}