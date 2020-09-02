<?php


class CategoryController
{

    const LIMIT = 6;

    public function actionIndex($cat_id,$page = 1)
    {
        $categoryList = array();
        $categoryList = Category::getCategoryList();
        $contentList = Content::getContentListByCategory($cat_id, $categoryList,'post',self::LIMIT,$page);
        $recommendationList = Content::getContentListByCategory($cat_id,$categoryList,'post',4);
        $pagination = new Pagination(Content::getTotalContentItemForCategory($cat_id,$categoryList),$page,self::LIMIT,'page-');
        require_once ROOT . '/views/category/index.php';

        return true;
    }

}