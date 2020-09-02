<?php
    class ManagerController
    {
        public static function actionIndex()
        {
            Manager::checkManager();
            $user = User::getUserDate($_SESSION['user']);
            $categoryList = array();
            $categoryList = Category :: getCategoryList();
            $orgItem  = Organization::getOrganizationById($_SESSION['org_id']);
            $postList = Content::getContentListByOrgId($_SESSION['org_id'],'post');
            $newsList = Content::getContentListByOrgId($_SESSION['org_id'],'news');
            require_once ROOT.'/views/manager/index.php';
            return true;
        }
        public static function actionCreateContent()
        {
            Manager::checkManager();
            $categoryList = array();
            $categoryList = Category :: getCategoryList();
            $title = '';
            $content = '';
            $category_id = '';
            $info_one = '';
            $info_two = '';
            $info_three = '';

            $errors = false;
            $result = false;
            if (isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $category_id = $_POST['category_id'];
                $type = $_POST['type'];
                $published = $_POST['published'];
                $org_id = $_SESSION['org_id'];
                $info_one = $_POST['one_info'];
                $info_two = $_POST['two_info'];
                $info_three = $_POST['three_info'];
                $date = date('Y-m-d H:i:s');
                if (Content::checkInputData($title,$content,$category_id))
                {
                 echo $date;
                    $result = Content::createContentItem($title,$content,$published,$type,$category_id,$org_id,$date,$info_one,$info_two,$info_three);
                    echo $result;
                    if ($result)
                        if (is_uploaded_file($_FILES['img']['tmp_name']))
                        {
                            move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/upload/img/content/content{$result}.jpg");
                        }
                    header("Location: /manager/");
                }
                else
                    $errors = true;
            }
            require_once ROOT . '/views/manager/createContent.php';
            return true;
        }
        public static function actionUpdateContent($content_id)
        {
            $categoryList = array();
            $categoryList = Category :: getCategoryList();
            Manager::checkManager();
            $contentItem = Content::getContentItemById($content_id);
            if (Content::checkOrganization($contentItem['org_id']))
            {

                $errors = false;
                $result = false;

                $title = $contentItem['title'];
                $content = $contentItem['content'];
                $category_id = $contentItem ['category_id'];
                $published = $contentItem['published'];
                $type = $contentItem['type'];
                $one_info = $contentItem['one_info'];
                $two_info = $contentItem['two_info'];
                $three_info = $contentItem['three_info'];
                if (isset($_POST['submit']))
                {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $category_id = $_POST['category_id'];
                    $published = $_POST['published'];
                    $type = $_POST['type'];
                    $one_info = $_POST['one_info'];
                    $two_info = $_POST['two_info'];
                    $three_info = $_POST['three_info'];
                    if (Content::checkInputData($title, $content, $category_id)) {
                        $contentItem['title'] = $title;
                        $contentItem['content'] = $content;
                        $contentItem['category_id'] = $category_id;
                        $contentItem['published'] = $published;
                        $contentItem['type'] = $type;
                        $contentItem['one_info']=$one_info;
                        $contentItem['two_info']=$two_info;
                        $contentItem['three_info']=$three_info;
                        $result = Content::updateContentItem($contentItem);
                        if ($content_id)
                            if (is_uploaded_file($_FILES['img']['tmp_name']))
                            {
                                move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/upload/img/content/content{$content_id}.jpg");
                            }
                        header("Location: /manager");
                    } else
                        $errors = true;
                }
                require_once ROOT . '/views/manager/updateContent.php';
            }
            return true;
        }
        public static function actionDeleteContent($content_id)
        {
            $categoryList = array();
            $categoryList = Category :: getCategoryList();
            $content_item = Content::getContentItemById($content_id);
            if (Content::checkContentOrganization($content_item['org_id']))
            {

                if (isset($_POST['Yes']))
                {
                    Content::deleteContent($content_id);
                    header("Location: /manager/");
                }
                else if (isset($_POST['No']))
                    header("Location: /manager/");

                require_once ROOT . '/views/manager/deleteContent.php';
            }
            return true;
        }
        public static function actionChangeContentStatus($content_id)
        {
            Manager::checkManager();
            $res = Content::changeContentStatusById($content_id);
            header("Location: /manager/");
            return true;
        }
    }