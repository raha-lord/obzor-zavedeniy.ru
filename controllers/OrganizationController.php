<?php


class OrganizationController
{
    public function actionIndex($id,$page = 1)
    {
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $org_item = Organization::getOrganizationById($id);

        $pagination = new Pagination(Content::getTotalContentItemForOrganization($id),$page,Content::SHOW_BY_DEFAULT,'page-');
        $contentList = Content::getContentListByOrgId($id,'post');

        require_once ROOT.'/views/organizations/index.php';
        return true;
    }
    public function actionCreate()
    {
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $email ='';
        $password ='';
        $name ='';
        $category_id ='';
        $description = '';
        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
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
            if ($name=='')
                $errors[]= 'Введите название!';
            if ($category_id==''||$category_id==0)
                $errors[]= 'Укажите категорию!';
            if ($description=='')
                $errors[]= 'Напишите описание !';
            if ($errors==false)
            {
                $result = Organization::createOrganization($name,$category_id,$description);
                if ($result)
                    if (is_uploaded_file($_FILES['img']['tmp_name']))
                    {
                        move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/upload/img/org/org{$result}.jpg");
                    }
                $org_item = Organization::getItemForName($name);
                $result = User::register($email,$password,$role,$org_item['id']);
                $userId = User::checkUserData($email,$password);
                User::auth($userId,$role,$org_item['id']);
                header("Location: /manager/");
            }
        }

        require_once ROOT.'/views/organizations/create.php';
        return true;
    }
    public function actionChange()
    {
        $manager= Manager::checkManager();
        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $org_item = Organization::getOrganizationById($_SESSION['org_id']);
        $org_id = $_SESSION['org_id'];
        $name = $org_item['name'];
        $description = $org_item['description'];
        $category_id = $org_item['category_id'];
        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $errors = false;

            if ($name=='')
                $errors[]= 'Введите название!';
            if ($category_id==''||$category_id==0)
                $errors[]= 'Укажите категорию!';
            if ($description=='')
                $errors[]= 'Напишите описание !';
            if ($errors==false)
            {
                $result = Organization::updateOrganizationById($org_id,$name,$category_id,$description);
                if ($result)
                    if (is_uploaded_file($_FILES['img']['tmp_name']))
                    {
                        move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/upload/img/org/org{$org_id}.jpg");
                    }
                header("Location: /manager/");
            }
        }

        require_once ROOT.'/views/organizations/change.php';
        return true;

    }
}