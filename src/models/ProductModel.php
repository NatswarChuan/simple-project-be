<?php
class ProductModel extends Db
{
    /**
     * Lấy 12 sản phẩm có lượt xem cao nhất và status = 1
     * Nếu trùng lượt xem sắp xếp theo Id giảm dần 
     */
    public function getProductsHot()
    {
        $sql = parent::$conection->prepare("SELECT * FROM `product` WHERE `status` = 1 ORDER BY `product_view` DESC, `product_id` DESC LIMIT 0,12");
        return parent::select($sql);
    }

    /**
     * Lấy 12 sản phẩm có tỷ lệ giảm giá cao nhất và status = 1
     * Nếu trùng tỷ lệ giảm giá sắp xếp theo Id giảm dần 
     */
    public function getProductsSale()
    {
        $sql = parent::$conection->prepare("SELECT * FROM `product` WHERE `status` = 1 ORDER BY `product_sale` DESC, `product_id` DESC LIMIT 0,12");
        return parent::select($sql);
    }

    /**
     * Lấy sản phẩm thuộc danh mục theo trang sắp xếp theo Id và status = 1
     * mỗi trang 12 sản phẩm
     */
    public function getProductsCategory($id, $name, $page)
    {
        $start = ($page - 1) * 12;
        $sql = parent::$conection->prepare("SELECT
        `product`.*
    FROM
        `product`
    JOIN `categories_products` ON `categories_products`.`product_id` = `product`.`product_id`
    JOIN `categories` ON `categories_products`.`category_id` = `categories`.`categories_id`
    WHERE
        `product`.`status` = 1 AND `categories_products`.`category_id` = ? AND `categories`.`category_name` LIKE ?
    ORDER BY
        `product`.`product_id`
    DESC
    LIMIT ?, 12");
        $sql->bind_param("isi", $id, $name, $start);
        return parent::select($sql);
    }

    /**
     * Lấy số lượng sản phẩm thuộc danh mục
     */
    public function getCountProductsCategory($id, $name)
    {
        $sql = parent::$conection->prepare("SELECT
        COUNT(`product`.`product_id`)
    FROM
        `product`
    JOIN `categories_products` ON `categories_products`.`product_id` = `product`.`product_id`
    JOIN `categories` ON `categories_products`.`category_id` = `categories`.`categories_id`
    WHERE
        `product`.`status` = 1 AND `categories_products`.`category_id` = ? AND `categories`.`category_name` LIKE ?");
        $sql->bind_param("is", $id, $name);
        return parent::select($sql)[0]['COUNT(`product`.`product_id`)'];
    }

    /**
     * Lấy thông tin của sản phẩm
     * Nếu sản phẩm không tồn tại trả về null
     */
    public function getProductInfo($id, $name)
    {
        $sql = parent::$conection->prepare("SELECT * FROM `product` WHERE `product_id` = ? AND `product_title` LIKE ? AND `status` = 1");
        $sql->bind_param("is", $id, $name);
        $result = parent::select($sql);
        return count($result) != 0 ? parent::select($sql)[0] : null;
    }

    /**
     * Cập nhật lượt truy cập của sản phẩm
     */
    public function updateViewProduct($id, $name)
    {
        $sql = parent::$conection->prepare("UPDATE `product` SET `product_view` = `product_view`+1 WHERE `product_id` = ? AND `product_title` LIKE ?");
        $sql->bind_param("is", $id, $name);
        return $sql->execute();
    }

    public function getProductsSearch($search)
    {
        $search = '%' . $search . '%';
        $sql = parent::$conection->prepare("SELECT * FROM `product` WHERE `product_title` LIKE ? AND `status` = 1 ORDER BY `product_sale` DESC, `product_id` DESC LIMIT 0,12");
        $sql->bind_param("s", $search);
        return parent::select($sql);
    }

    public function getCountProductsSearch($search)
    {
        $search = '%' . $search . '%';
        $sql = parent::$conection->prepare("SELECT
        COUNT(`product`.`product_id`)
        FROM `product` 
        WHERE `product_title` LIKE ? AND `status` = 1");
        $sql->bind_param("s", $search);
        return parent::select($sql)[0]['COUNT(`product`.`product_id`)'];
    }
}
