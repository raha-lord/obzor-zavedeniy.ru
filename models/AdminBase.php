<?php


abstract class  AdminBase
{
    public static function checkAdmin()
    {
        $user = User::checkLogged();
        if ($user['role']=='admin')
            return true;
        die("Access denied");
    }
}