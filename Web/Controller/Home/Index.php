<?php
APP || die();

class Web_Controller_Home_Index extends Sys_Controller_Default
{

    public function Get($param) 
    {
        return "HomeData Get";
    }
    
    public function Post($param) 
    {
        return "HomeData Post";
    }
}