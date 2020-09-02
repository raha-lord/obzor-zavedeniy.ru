<?php

class SiteController
{
    public function actionIndex()
    {

        $categoryList = array();
        $categoryList = Category :: getCategoryList();
        $subcatList = Category::getCategoryByLevel(1);
        $contentList = array();
        $contentList = Content::getContentListForMain();
        require_once(ROOT.'/views/site/index.php');

        return true;
    }

}