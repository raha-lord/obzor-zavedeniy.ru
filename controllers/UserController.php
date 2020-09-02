<?php

class UserController
{
    function actionRegister()
    {
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $email ='';
        $password ='';
        if (isset($_POST['submit']))
        {
            $role = $_POST['role'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;

            if (!User::checkLogin($email))
                $errors[]= 'Неправильный email!';
            if (!User::checkPassword($password))
                $errors[]= 'Парольдолжен быть длигнн 6 символов!';
            if (User::checkLoginExist($email))
                $errors[]= 'Такой логин уже есть!';
            if ($errors==false)
            {
                $result = User::register($email,$password,$role);
                if ($result)
                    if (is_uploaded_file($_FILES['img']['tmp_name']))
                    {
                        move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/upload/img/user/user{$result}.jpg");
                    }
                $userId = User::checkUserData($email,$password);
                $user = User::getUserDate($userId);
                User::auth($userId,$role);
                header("Location: /cabinet/");

            }
        }
        require_once(ROOT . '/views/users/register.php');
        return true;
    }
    function actionLogin()
    {
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $email ='';
        $password ='';
        if (isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            if (!User::checkLogin($email))
                $errors[]='Не праильный email';
            if (!User::checkPassword($password))
                $errors[]='Не правильный пароль!';

            $userId = User::checkUserData($email,$password);
            if ($userId == false)
            {
                $errors[] = 'Непраильые данные для входа на сайт!';
            }
            else
            {
                $user = User::getUserDate($userId);
                User::auth($userId,$user['role'],$user['organization_id']);
                if ($_SESSION['role']=='admin')
                    header("Location: /admin/");
                else if ($_SESSION['role']=='manager')
                    header("Location: /manager/");
                else
                    header("Location: /cabinet/");
            }

        }
        require_once (ROOT.'/views/users/login.php');

        return true;
    }
    function actionLogout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }
}
