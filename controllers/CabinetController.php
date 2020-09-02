<?php


class CabinetController
{
    function actionIndex()
    {
        $user = User::checkLogged();
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $userDate = User::getUserDate($user['id']);
        require_once ROOT.'/views/cabinet/index.php';
        return true;
    }
    function actionEdit()
    {
        $user = User::checkLogged();
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $userDate = User::getUserDate($user['id']);
        $categoryList = Category :: getCategoryList();
        $email = $userDate['email'];
        $password = $userDate ['password'];
        $result = false;
            if (isset($_POST['submit']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $errors = false;
                if (!User::checkLogin($email))
                    $errors[]='Не праильный email';
                if (!User::checkPassword($password))
                    $errors[]='Не правильный пароль!';

                if ($errors == false)
                {
                    $result = User::edit($user['id'],$email,$password);
                }
            }
            require_once (ROOT.'/views/cabinet/login.php');
            return true;
    }
    function actionLogout()
    {
        User::logOut();
        header('Location: /');
    }

}