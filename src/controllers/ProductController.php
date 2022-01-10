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
        $products = [];
        $total = 0;
        $productModel = new ProductModel();
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $product = $productModel->getProductInfo($key, $value);
                array_push($products, $product);
                $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                $total += $price;
            }
        }
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
        $products = [];
        $total = 0;
        $productModel = new ProductModel();
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $product = $productModel->getProductInfo($key, $value);
                array_push($products, $product);
                $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                $total += $price;
            }
        }
        include ROOT_DIR . '/src/views/user/thanh-toan.php';
    }

    public static function SearchController()
    {
        $productModel = new ProductModel();
        if (empty($_GET['search'])) {
            include ROOT_DIR . '/src/views/admin/404.php';
        } else {
            $search = $_GET['search'];
            $products = $productModel->getProductsSearch($search);
            $page = 1;
            if (count(URL) > 1) {
                $arr = explode("-", URL[1]);
                $page = $arr[count($arr) - 1];
            }
            $count = $productModel->getCountProductsSearch($search);
            $count = $count % 12 == 0 ? intval($count / 12) : intval($count / 12) + 1;

            $link = BASE_URL . '/tim-kiem/trang-';
            include ROOT_DIR . '/src/views/user/tim-kiem.php';
        }
    }

    public static function AddCartController()
    {
        if (count(URL) > 1) {
            $arr = explode("-", URL[1]);
            $id = $arr[count($arr) - 1];
            unset($arr[count($arr) - 1]);
            $name = "%" . implode("%", $arr) . "%";
            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = [$id =>  $name];
            } else {
                $_SESSION['cart'][$id] = $name;
            }
            header("Location: " . BASE_URL . '/san-pham/' . URL[1]);
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }

    public static function RemoveCartItemController()
    {
        if (count(URL) > 1 && !empty($_SESSION['cart'])) {
            unset($_SESSION['cart'][URL[1]]);
            header("Location: " . BASE_URL . '/gio-hang');
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }
    public static function CheckoutCartController()
    {
        if (!empty($_SESSION['cart']) && !empty($_GET['address']) && !empty($_GET['phone']) && !empty($_GET['customer'])) {
            $address = $_GET['address'];
            $phone = $_GET['phone'];
            $customer = $_GET['customer'];
            var_dump($address);
            var_dump($phone);
            var_dump($customer);
            // header("Location: " . BASE_URL . '/trang-chu');
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }

    //Thêm sản phẩm
    public static function AddProductController()
    {
        $categoryModel = new CategoryModel();
        $categories =  $categoryModel->getCategories();
        include ROOT_DIR . '/src/views/admin/them-san-pham.php';
    }

    public static function ConfirmAddProductController()
    {
        $productModel = new ProductModel();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $image = $_POST['image'];
        $desciption = $_POST['desciption'];
        $categories = [];
        foreach ($_POST as $key => $value) {
            if ($key != 'name' && $key != 'price' && $key != 'sale' && $key != 'image' && $key != 'desciption') {
                array_push($categories, $value);
            }
        }
        $productModel->InsertProduct($name, $price, $sale, $desciption, $image, $categories);
        header("Location: " . BASE_URL . '/danh-sach-san-pham');
    }

    public static function UpdateProductController()
    {
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $categories =  $categoryModel->getCategories();
        if (count(URL) > 1) {

            $arr = explode("-", URL[1]);
            $id = $arr[count($arr) - 1];
            unset($arr[count($arr) - 1]);
            $name = "%" . implode("%", $arr) . "%";

            $product = $productModel->getProductInfoAdmin($id, $name);
            if (empty($product)) {
                include ROOT_DIR . '/src/views/admin/404.php';
            } else {
                $categories_product = $categoryModel->getCategoriesProduct($id);
                include ROOT_DIR . '/src/views/admin/sua-san-pham.php';
            }
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }

    public static function ConfirmUpdateProductController()
    {
        $productModel = new ProductModel();
        if (count(URL) > 1) {

            $arr = explode("-", URL[1]);
            $id = $arr[count($arr) - 1];
            unset($arr[count($arr) - 1]);
            $title = "%" . implode("%", $arr) . "%";

            $name = $_POST['name'];
            $price = $_POST['price'];
            $sale = $_POST['sale'];
            $image = $_POST['image'];
            $desciption = $_POST['desciption'];
            $status = empty($_POST['status']) ? 0 : 1;
            $last_update = $_POST['last_update'];
            $categories = [];
            foreach ($_POST as $key => $value) {
                if ($key != 'name' && $key != 'price' && $key != 'sale' && $key != 'image' && $key != 'desciption' && $key != 'descistatusption' && $key != 'last_update') {
                    array_push($categories, $value);
                }
            }
            $productModel->UpdateProduct($name, $price, $sale, $desciption, $image, $categories, $title, $id, $last_update, $status);
            header("Location: " . BASE_URL . '/danh-sach-san-pham');
        } else {
            include ROOT_DIR . '/src/views/admin/404.php';
        }
    }

    public static function ProductListController()
    {
        $productModel = new ProductModel();
        $page = 1;
        if (count(URL) > 1) {
            $arr = explode("-", URL[1]);
            $page = $arr[count($arr) - 1];
        }
        $products = $productModel->getProductsAdmin($page);
        $link = BASE_URL . '/' . URL[0] . '/trang-';
        $count = $productModel->getCountProductsAdmin();
        $count = $count % 12 == 0 ? intval($count / 12) : intval($count / 12) + 1;
        include ROOT_DIR . '/src/views/admin/danh-sach-san-pham.php';
    }
}
