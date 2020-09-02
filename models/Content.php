<?php


class Content
{
    const SHOW_BY_DEFAULT = 10;
    //published=1;unpublished=0;all status=2
    const PUBLISHED = 1;

    //crate/delete/update
    public static function createContentItem($title,$content,$published,$type,$category_id,$org_id,$date,$one_info,$two_info,$three_info)
    {
        $db = DB::getConnection();
        $sql = 'INSERT INTO content (title,content,type,category_id,org_id,date,published,one_info,two_info,three_info)'
            .'VALUES (:title,:content,:type,:category_id,:org_id,:date,:published,:one_info,:two_info,:three_info)';
        $result = $db->prepare($sql);
        $result->bindParam(':title',$title,PDO::PARAM_STR);
        $result->bindParam(':content',$content,PDO::PARAM_STR);
        $result->bindParam(':type',$type,PDO::PARAM_STR);
        $result->bindParam(':published',$published,PDO::PARAM_INT);
        $result->bindParam(':category_id',$category_id,PDO::PARAM_INT);
        $result->bindParam(':org_id',$org_id,PDO::PARAM_INT);
        $result->bindParam(':date',$date,PDO::PARAM_STR);
        $result->bindParam(':one_info',$one_info,PDO::PARAM_STR);
        $result->bindParam(':two_info',$two_info,PDO::PARAM_STR);
        $result->bindParam(':three_info',$three_info,PDO::PARAM_STR);
        if ($result->execute())
            return $db->lastInsertId();
        return 0;
    }
    public static function updateContentItem($content)
    {
        $date = date( "y.m.d H:i:s" );
        $db = DB::getConnection();
        $sql = 'UPDATE content SET title = :title, content = :content,'
            .' category_id = :category_id, date = :date, published = :published,'
            .'one_info = :one_info, two_info = :two_info, three_info = :three_info'
            .' WHERE id =:content_id';

        $result = $db->prepare($sql);
        $result->bindParam(':content_id',$content['id'],PDO::PARAM_STR);
        $result->bindParam(':title',$content['title'],PDO::PARAM_STR);
        $result->bindParam(':content',$content['content'],PDO::PARAM_STR);
        $result->bindParam(':category_id',$content['category_id'],PDO::PARAM_INT);
        $result->bindParam(':published',$content['published'],PDO::PARAM_STR);
        $result->bindParam(':date',$date,PDO::PARAM_STR);
        $result->bindParam(':one_info',$content['one_info'],PDO::PARAM_STR);
        $result->bindParam(':two_info',$content['two_info'],PDO::PARAM_STR);
        $result->bindParam(':three_info',$content['three_info'],PDO::PARAM_STR);

        return $result->execute();
    }
    public static function deleteContent($content_id)
    {
        $db = DB::getConnection();
        $sql = 'DELETE FROM `content` WHERE `id` = :content_id';
        $result = $db->prepare($sql);
        $result->bindParam(':content_id',$content_id,PDO::PARAM_STR);
        return $result->execute();
    }
    public static function changeContentStatusById($id)
    {
        $db = DB::getConnection();
        $results = $db->query('SELECT published FROM content WHERE id='.$id);
        $results->setFetchMode(PDO::FETCH_ASSOC);
        $results = $results -> fetch();
        $results = $results['published'];
        if ($results == 0)
        {
            $sql = 'UPDATE content SET published = 1 WHERE id =:id';
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_STR);
            return $result->execute();
        }
        else
        {
            $sql = 'UPDATE content SET published = 0 WHERE id =:id';
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_STR);
            return $result->execute();
        }
    }
    //getContentItem
    public static function getContentItemById($id,$published = self::PUBLISHED)
    {
        if ($id)
        {
            $db = DB::getConnection();
            $contentItem = array();
            $result = $db->query('SELECT * FROM content where id = '.$id.' and published = '.$published);
            $result ->setFetchMode(PDO::FETCH_ASSOC);
            $contentItem = $result->fetch();
            return $contentItem;
        }

    }
    //getContentList
    public static function getContentListByOrgId($org_id,$type,$published = self::PUBLISHED,$page = 1)
    {
        if ($org_id)
        {
            $page = intval($page);
            $offset = ($page-1)*self::SHOW_BY_DEFAULT;
            $contentList = array();
            $type = "'".$type."'";
            $db = DB::getConnection();
            $results = $db->query('SELECT * FROM content where '
                .' org_id = '.$org_id
                .' AND type = '.$type
                .' AND published = '.$published
                .' LIMIT '.self::SHOW_BY_DEFAULT
                .' OFFSET '.$offset);
            $i = 1;

            while ($row = $results->fetch()) {
                $contentList[$i]['id'] = $row['id'];
                $contentList[$i]['category_id'] = $row['category_id'];
                $contentList[$i]['title'] = $row['title'];
                $contentList[$i]['content'] = $row['content'];
                $contentList[$i]['published'] = $row['published'];
                $contentList[$i]['type'] = $row['type'];
                $contentList[$i]['date'] = $row['date'];
                $contentList[$i]['org_id'] = $row['org_id'];
                $contentList[$i]['one_info'] = $row['one_info'];
                $contentList[$i]['two_info'] = $row['two_info'];
                $contentList[$i]['three_info'] = $row['three_info'];
                $i++;
            }
            return $contentList;
        }
        return 0;
    }
    public static function getContentList($type,$page = 1,$published = self::PUBLISHED)
    {
        $db = DB::getConnection();
        $offset = ($page-1)*self::SHOW_BY_DEFAULT;
        $contentList = array();
        $type = "'".$type."'";
        $results = $db->query('SELECT * FROM content WHERE '
            .' published = '.$published
            .' AND type = '.$type
            .' ORDER BY id LIMIT '.self::SHOW_BY_DEFAULT
            .' OFFSET '.$offset);
        $i= 1;

        while ($row = $results->fetch())
        {
            $contentList[$i]['id'] = $row['id'];
            $contentList[$i]['category_id'] = $row['category_id'];
            $contentList[$i]['title'] = $row['title'];
            $contentList[$i]['type'] = $row['type'];
            $contentList[$i]['date'] = $row['date'];
            $contentList[$i]['org_id'] = $row['org_id'];
            $contentList[$i]['one_info'] = $row['one_info'];
            $contentList[$i]['two_info'] = $row['two_info'];
            $contentList[$i]['three_info'] = $row['three_info'];
            $i++;
        }
        return $contentList;
    }
    public static function getContentListByCategory($category_id,$categoryList,$type,$limit=self::SHOW_BY_DEFAULT,$page=1,$published=self::PUBLISHED)
    {
        $db = DB::getConnection();
        $contentList = array();
        $offset = ($page-1)*$limit;
        $type = "'".$type."'";
        $queryCategory = Category::makeQueryStringOfChildCategory($category_id,$categoryList,Category::MAIN_LEVEL,Category::MAX_LEVEL);
        $results = $db->query('SELECT * FROM content where '
            .$queryCategory
            .' AND published = '.$published
            .' AND type = '.$type
            .' ORDER BY id LIMIT '.$limit
            .' OFFSET '.$offset);

        $i= 1;

        while ($row = $results->fetch())
        {
            $contentList[$i]['id'] = $row['id'];
            $contentList[$i]['category_id'] = $row['category_id'];
            $contentList[$i]['title'] = $row['title'];
            $contentList[$i]['type'] = $row['type'];
            $contentList[$i]['date'] = $row['date'];
            $contentList[$i]['org_id'] = $row['org_id'];
            $contentList[$i]['one_info'] = $row['one_info'];
            $contentList[$i]['two_info'] = $row['two_info'];
            $contentList[$i]['three_info'] = $row['three_info'];
            $i++;
        }
        return $contentList;
    }
    //get other
    public static function getContentImageById($id)
    {
        $noImage = 'no-image.jpg';
        $path = '/upload/img/content/';
        $allPatch = $path.'content'.$id.'.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$allPatch))
            return $allPatch;
        else
            return $path.$noImage;
    }
    public static function getContentListForMain()
    {
        $categoryList = Category::getCategoryList();
        $query = '';
        $contentList = array();
        $db = DB::getConnection();
        $i = 1;
        foreach ($categoryList as $cat)
        {
            $query ='SELECT * FROM content WHERE category_id = ' . $cat['id'].' AND published =1';
            $subCatList = Category::getSubcategoryListByCatId($cat['id']);
            foreach ($subCatList as $subCat) {
                $query = $query . " OR category_id = " . $subCat['id'].' AND published =1';
            }
            $query = $query . ' LIMIT 4 ';
            $results = $db->query($query);
            while ($row = $results->fetch())
            {
                $contentList[$i]['mather_cat_id'] = $cat['id'];
                $contentList[$i]['id'] = $row['id'];
                $contentList[$i]['category_id'] = $row['category_id'];
                $contentList[$i]['title'] = $row['title'];
                $contentList[$i]['content'] = $row['content'];
                $contentList[$i]['type'] = $row['type'];
                $contentList[$i]['date'] = $row['date'];
                $contentList[$i]['org_id'] = $row['org_id'];
                $contentList[$i]['one_info'] = $row['one_info'];
                $contentList[$i]['two_info'] = $row['two_info'];
                $contentList[$i]['three_info'] = $row['three_info'];
                $i++;
            }
        }
        return $contentList;
    }
    public static function checkContentOrganization($content_org_id)
    {
        if ($_SESSION['org_id']==$content_org_id)
            return true;
        die("Access denied");
    }
    public static function checkInputData($title,$content,$category)
    {
        if ($title == '')
            return false;
        if ($content == '')
            return false;
        if ($category == ''||$category==0)
            return false;
        return true;
    }
    public static function checkOrganization($item_org_id)
    {
        if ($_SESSION['org_id']==$item_org_id)
            return true;
        die("Access denied");
    }
    public static function getTotalContentItemForCategory($category_id,$categoryList,$published=self::PUBLISHED)
    {
        $db = DB::getConnection();
        $queryCategory = Category::makeQueryStringOfChildCategory($category_id,$categoryList,Category::MAIN_LEVEL,Category::MAX_LEVEL);
        $result = $db->query('SELECT count(id)  FROM content where '
            .' published = '.$published
            .' AND '.$queryCategory);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count(id)'];
    }
    public static function getTotalContentItemForOrganization($org_id,$published=self::PUBLISHED)
    {
        $db = DB::getConnection();
        $result = $db->query('SELECT count(id)  FROM content where '
            .' published = '.$published
            .' AND org_id = '.$org_id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count(id)'];
    }

}