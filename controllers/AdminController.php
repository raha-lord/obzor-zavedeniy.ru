<?php


class AdminController extends AdminBase
{
    public static function actionIndex()
    {
        self::checkAdmin();
        $userDate = User::getUserDate($_SESSION['user']);
        require_once ROOT.'/views/admin/indexAdmin.php';
        return true;
    }
}