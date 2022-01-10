<?php

/**
 * Khai báo route
 * Nếu URL không có mặc định quay về trang chủ
 * Nếu URL chưa được khai báo chuyển đến trang 404
 * Nếu URL đã được khai báo chuyển đến Controller tương ứng đã khai báo
 * */
if (count(URL) != 0) {
    switch (URL[0]) {
        case 'trang-chu':
            ProductController::HomeController();
            break;
        case 'danh-muc':
            ProductController::CategoryController();
            break;
        case 'gio-hang':
            ProductController::CartController();
            break;
        case 'san-pham':
            ProductController::ProductInfoController();
            break;
        case 'thanh-toan':
            ProductController::CheckoutController();
            break;
        case 'tim-kiem':
            ProductController::SearchController();
            break;
        case 'add-cart':
            ProductController::AddCartController();
            break;
        case 'remove-cart-item':
            ProductController::RemoveCartItemController();
            break;
        case 'check-out':
            ProductController::CheckoutCartController();
            break;
        case 'them-san-pham':
            ProductController::AddProductController();
            break;
        case 'su-ly-them-san-pham':
            ProductController::ConfirmAddProductController();
            break;
        case 'sua-san-pham':
            ProductController::UpdateProductController();
            break;
        case 'su-ly-sua-san-pham':
            ProductController::ConfirmUpdateProductController();
            break;
        case 'danh-sach-san-pham':
            ProductController::ProductListController();
            break;
        default:
            include ROOT_DIR . '/src/views/admin/404.php';
            break;
    }
} else {
    ProductController::HomeController();
}
