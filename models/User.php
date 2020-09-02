<?php


class User
{
    public static function register($email,$password,$role,$organization_id = 0)
    {
        $db = DB::getConnection();
        $sql = 'INSERT INTO user (email,password,role,organization_id)'
                .'VALUES(:email,:password,:role,:organization_id)';
        $result = $db->prepare($sql);
        $result->bindParam(':email',$email,PDO::PARAM_STR);
        $result->bindParam(':password',$password,PDO::PARAM_STR);
        $result->bindParam(':role',$role,PDO::PARAM_STR);
        $result->bindParam(':organization_id',$organization_id,PDO::PARAM_STR);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    public static function checkLogin($login)
    {
        if (filter_var($login,FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }
    public static function checkPassword($password)
    {
        if (strlen($password)>=6)
            return true;
        return false;
    }
    public static function checkLoginExist($login)
    {
        $db = DB::getConnection();
        $sql ='SELECT COUNT(*) FROM user WHERE email = :email';
        $result = $db->prepare($sql);
        $result -> bindParam(':email',$login,PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
        return false;
    }
    public static function checkUserData($email,$password)
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $result = $db->prepare($sql);
        $result ->bindParam(':email',$email,PDO::PARAM_STR);
        $result ->bindParam(':password',$password,PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user)
            return $user['id'];
        return false;
    }
    public static function auth($userId,$role = 0,$org_id = 0)
    {
        $_SESSION['user'] = $userId;
        $_SESSION['org_id'] = $org_id;
        $_SESSION['role'] = $role;
    }
    public static function logOut()
    {
        $_SESSION = array();
    }
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])&&isset($_SESSION['org_id'])&&isset($_SESSION['role']))
        {
            $user_info = array();
            $user_info['id'] = $_SESSION['user'];
            $user_info['org_id'] = $_SESSION['org_id'];
            $user_info['role'] = $_SESSION['role'];

            return $user_info;
        }
        header("Location: /user/login");
    }
    public static function isGuest()
    {
        if (isset($_SESSION['user']))
            return false;
        return true;
    }
    public static function getUserDate($userId)
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM user WHERE id = :id ';
        $result = $db->prepare($sql);
        $result ->bindParam(':id',$userId,PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $user = $result->fetch();
        if ($user)
            return $user;
        return false;
    }
    public static function edit($userId,$email,$password)
    {
        $db = DB::getConnection();
        $sql = 'UPDATE `user` SET `email` = :email, `password`= :password WHERE `user`.`id` = :id';


        $result = $db->prepare($sql);
        $result->bindParam(':email',$email,PDO::PARAM_STR);
        $result->bindParam(':password',$password,PDO::PARAM_STR);
        $result->bindParam(':id',$userId,PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getUserImgById($id)
    {
        $noImage = 'no-image.jpg';
        $path = '/upload/img/user/';
        $allPatch = $path.'user'.$id.'.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$allPatch))
            return $allPatch;
        else
            return $path.$noImage;
    }

}