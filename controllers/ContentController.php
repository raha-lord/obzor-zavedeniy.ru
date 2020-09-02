<?php


class ContentController
{
    public function actionIndex()
    {

        require_once (ROOT.'/views/content/index.php');
        return true;
    }

    public function actionView($s)
    {
        $categoryList = array();
        $categoryList = Category::getCategoryList();
        $contentItem = Content::getContentItemById($s);
        $org_item = Organization::getOrganizationById($contentItem['org_id']);
        $recommendationList = Content::getContentListByCategory($contentItem['category_id'],$categoryList,'post',4);
        if (count($org_item)==0)
        {
            Errors::getNotFoundError();
            return true;
        }
        require_once (ROOT.'/views/content/view.php');
        return true;
    }

}