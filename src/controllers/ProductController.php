<?php
class ProductController
{
    /**
     * HomeController
     * Lấy các thông tin về các sản phẩm đang được giảm giá và các sản phẩm có nhiều lượt xem
     * Hiển thị giao diện trang chủ
     */
    public static function HomeController()
    {
        $productModel = new ProductModel();
        $productsSale = $productModel->getProductsSale();
        $productsHot = $productModel->getProductsHot();
        include ROOT_DIR . '/src/views/user/index.php';
    }

    /**
     * CategoryController
     * Lấy các thông tin về danh mục và các sản phẩm thuộc danh mục
     * Hiển thị giao diện trang danh mục
     */
    public static function CategoryController()
    {
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $categories =  $categoryModel->getCategories();
        /**
         * Nếu URL > 1 => đã xác định danh mục => Nếu danh mục không tồn tại => hiển thị trang 404
         * Ngược lại => chưa xác định danh mục => điều hướng đến danh mục đầu tiên trong mảng danh mục
         */
        if (count(URL) > 1) {
            /**
             * Tách chuỗi tên-id thành 2 biến name và id
             */
            $arr = explode("-", URL[1]);
            $id = $arr[count($arr) - 1];
            unset($arr[count($arr) - 1]);
            $name = "%" . implode("%", $arr) . "%";

            /**
             * Mặc định page = 1
             * Nếu URL > 2 => có số trang => gắn page lại bằng cách tách chuỗi trang-page
             */
            $page = 1;
            if (count(URL) > 2) {
                $arr = explode("-", URL[2]);
                $page = $arr[count($arr) - 1];
            }

            /** 
             * Lấy số lượng sản phẩm hiện đang có dùng để phân trang (mỗi trang 12 sản phẩm)
             * Nếu số lượng sản phẩm không chia hết cho 12 => cộng thêm 1 vào số trang
             */
            $count = $productModel->getCountProductsCategory($id, $name);
            $count = $count % 12 == 0 ? intval($count / 12) : intval($count / 12) + 1;

            /**
             * Tạo đường dẫn dùng cho phân trang
             */
            $link = BASE_URL . '/danh-muc/' . URL[1] . '/trang-';
            $products = $productModel->getProductsCategory($id, $name, $page);
            include ROOT_DIR . '/src/views/user/danh-muc.php';
        } else {
            /**
             * Chuyển hướng đường dẫn
             */
            header("Location: " . BASE_URL . '/danh-muc/' . TienIch::vn_to_str($categories[0]['category_name']) . '-' . $categories[0]['categories_id']);
        }
    }

    public static function CartController()
    {
        include ROOT_DIR . '/src/views/user/gio-hang.php';
    }

    /**
     * ProductInfoController
     * Lấy thông tin sản phẩm
     * Cập nhật lượt truy cập vào sản phẩm (lưu lại trong cookie 24h)
     */
    public static function ProductInfoController()
    {
        /**
         * Nếu URL > 1 => đã xác định sản phẩm => sản phẩm không tồn tại => hiển thị trang 404
         * Ngược lại => chưa xác định sản phẩm => hiển thị trang 404
         */
        $productModel = new ProductModel();
        if (count(URL) > 1) {
            /**
             * Tách chuỗi tên-id thành 2 biến name và id
             */
            $arr = explode("-", URL[1]);
            $id = $arr[count($arr) - 1];
            unset($arr[count($arr) - 1]);
            $name = "%" . implode("%", $arr) . "%";

            /**
             * Kiểm tra cookie đã lưu lần cập lượt xem của sản phẩm này chưa
             * Nếu chưa => lưu cookie => cập nhật lượt xem 
             */
            if (empty($_COOKIE[URL[1]])) {
                setcookie(URL[1], true, time() + 86400);
                $productModel->updateViewProduct($id, $name);
            }

            /**
             * Lấy thông tin sản phẩm
             * Nếu sản phẩm không tồn tại => hiển thị trang 404
             * Nếu sản phẩm tồn tại => cắt chuỗi product_image thành mảng hình ảnh để hiển thị, tính giá tiền sản phẩm sau khi giảm giá => hiển thị giao diện trang thông tin sản phẩm
             */
            $product = $productModel->getProductInfo($id, $name);
            if (empty($product)) {
                include ROOT_DIR . '/src/views/admin/404.php';
            } else {
                $product_image = explode(",", $product['product_image']);
                $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                include ROOT_DIR . '/src/views/user/san-pham.php';
            }
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }

    public static function CheckoutController()
    {
        include ROOT_DIR . '/src/views/user/thanh-toan.php';
    }
}
