<?php


class Category
{
    const PUBLISHED = 1;
    const MAIN_LEVEL = 0;
    const SUB_LEVEL = 1;
    const MAX_LEVEL = 2;
    public static function getCategoryList($published = self::PUBLISHED)
    {
        $categoryList = array();
        $db = DB::getConnection();

        $results = $db->query('SELECT * FROM category WHERE published = '.$published.' ORDER BY id LIMIT 20');

        $i = 1;
        while ($row = $results->fetch())
        {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['level'] = $row['level'];
            $categoryList[$i]['mother_id'] = $row['mother_id'];

            $i++;
        }
        return $categoryList;
    }
    public static function getCategoryListByLevel($level=self::MAIN_LEVEL, $published = self::PUBLISHED)
    {
        $categoryList = array();
        $db = DB::getConnection();

        $results = $db->query('SELECT * FROM category WHERE level = '.$level.' AND published = '.$published.' ORDER BY id LIMIT 20');

        $i = 1;
        while ($row = $results->fetch())
        {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];

            $i++;
        }
        return $categoryList;
    }
    public static function getSubcategoryListByCatId($id,$level= self::SUB_LEVEL,$published = self::PUBLISHED)
    {
        $categoryList = array();
        $db = DB::getConnection();

        $results = $db->query('SELECT * FROM category where level= '.$level.' AND mother_id = '.$id.' AND published = '.$published.' ORDER BY id LIMIT 20');

        $i = 1;
        while ($row = $results->fetch())
        {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];

            $i++;
        }
        return $categoryList;
    }
    public static function getCategoryByLevel($level=self::MAIN_LEVEL,$published=self::PUBLISHED)
    {
        $db= DB::getConnection();
        $categoryList = Array();
        $results = $db->query('SELECT * FROM category where level = '.$level.' AND published = '.$published.' ORDER BY id LIMIT 100');
        $i=1;
        while ($row = $results->fetch())
        {
            $categoryList[$i]['id']= $row['id'];
            $categoryList[$i]['name']= $row['name'];
            $categoryList[$i]['mother_id']= $row['mother_id'];
            $i++;
        }
        return $categoryList;
    }
    //Get all Child category and string
    public static function getAllChildOfCategory($cat_id,$categoryList,$level = self::MAIN_LEVEL,$max_level =self::MAX_LEVEL)
    {
        $newId = array();
        foreach ($cat_id as $id)
        {
            array_push($newId,$id);
        }
        foreach ($cat_id as $id)
        {
            if (is_array($categoryList))
            {
                foreach ($categoryList as $category) {
                    if ($category['mother_id'] == $id && $category['level'] == $level) {
                        array_push($newId, $category['id']);
                    }
                }
            }
        }
        if ($level<=$max_level)
        {
            $level++;
            return self::getAllChildOfCategory($newId,$categoryList,$level,$max_level);
        }
        return $newId;
    }
    public static function makeQueryStringOfChildCategory($cat_id,$categoryList,$level = self::MAIN_LEVEL,$max_level =self::MAX_LEVEL)
    {
        $cat_id = array($cat_id);
        $cat_list = self::getAllChildOfCategory($cat_id,$categoryList,$level,$max_level);
        $string = 'category_id = '.$cat_list[0];
        for ($i = 1;$i<count($cat_list);$i++)
        {
            $string = $string.' or category_id = '.$cat_list[$i];
        }
        return $string;
    }


}