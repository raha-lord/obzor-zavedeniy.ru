<?php
class Errors
{
    public static function getNotFoundError()
    {
        if (ob_get_length()!=0)
            ob_end_clean();
        $categoryList = Category::getCategoryList(1);
        require_once (ROOT.'/views/errors/404.php');
    }
}