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

    public function getCategoriesProduct($id)
    {
        $sql = parent::$conection->prepare("SELECT `categories`.* FROM `categories_products` JOIN `categories` ON `categories_products`.`category_id` = `categories`.`categories_id` WHERE `product_id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}
