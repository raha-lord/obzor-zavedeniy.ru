<?php


class Organization
{
    public static function getOrganizationById($organization_id)
    {
        if ($organization_id)
        {
            $db = DB::getConnection();
            $results = $db->query('SELECT * FROM organization where id='.$organization_id);
            $results->setFetchMode(PDO::FETCH_ASSOC);
            return $organization_items = $results -> fetch();
        }

    }
    public static function createOrganization($name,$category_id,$description)
    {
        $db = DB::getConnection();
        $sql = 'INSERT INTO organization (name,category_id,description)'
            .'VALUES(:name,:category_id,:description)';
        $result = $db->prepare($sql);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':category_id',$category_id,PDO::PARAM_STR);
        $result->bindParam(':description',$description,PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;

    }
    public static function getItemForName($name)
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM organization WHERE name = :name';
        $result = $db->prepare($sql);
        $result ->bindParam(':name',$name,PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);


        $org_item = $result -> fetch();
        if ($org_item)
            return $org_item;
        return false;

    }
    public static function getOrgImgById($id)
    {
        $noImage = 'no-image.jpg';
        $path = '/upload/img/org/';
        $allPatch = $path.'org'.$id.'.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$allPatch))
            return $allPatch;
        else
            return $path.$noImage;
    }
    public static function updateOrganizationById($org_id,$name,$category_id,$description)
    {
        $db = DB::getConnection();
        $sql = 'UPDATE organization SET category_id =:category_id, name = :name, description = :description WHERE id =:org_id';
        $result = $db->prepare($sql);
        $result->bindParam(':org_id',$org_id,PDO::PARAM_STR);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':category_id',$category_id,PDO::PARAM_STR);
        $result->bindParam(':description',$description,PDO::PARAM_STR);
        return $result->execute();
    }
}