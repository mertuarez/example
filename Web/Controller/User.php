<?php
APP || die();

class Web_Controller_User extends Sys_Controller_Default
{
    public function IndexAction() 
    {
        

        $x = new Web_Model_User();
        $x->id = null;
        $x->firstname = "first";
        $x->lastname = "last";
        $x->created = "2018-05-28 16:18:47";

        //$this->mapper->UnMap("insert into users (id,firstname,lastname,created) values (:id,:firstname,:lastname,:created)", $x);

        $result = $this->mapper->Map("select * from users", "Web_Model_User");
        return $this->View("index", $result);
    }
}