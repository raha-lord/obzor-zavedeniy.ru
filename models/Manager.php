<?php


class Manager
{
    public static function checkManager()
    {
        $user = User::checkLogged();
        if ($user['role']=='manager')
                return true;
        die("Access denied");
    }
}