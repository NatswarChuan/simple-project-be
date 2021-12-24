<?php
class CategoryModel extends Db
{
    /**
     * Lấy danh sách Danh mục
     */
    public function getCategories()
    {
        $sql = parent::$conection->prepare("SELECT * FROM `categories` WHERE `status` = 1");
        return parent::select($sql);
    }
}
