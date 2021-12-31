<!-- Trang danh mục -->

<?php
include ROOT_DIR . '/src/views/user/head.php';
?>

<body>
    <?php
    include ROOT_DIR . '/src/views/user/navbar.php';
    ?>
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Danh mục</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                        mattis vitae leo.</p>
                </div>
                <div class="content">
                    <div class="products">
                        <div class="row no-gutters">
                            <?php
                            foreach ($products as $product) {
                                $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                            ?>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="clean-product-item">
                                        <div class="image"><a href="<?php echo BASE_URL . '/san-pham/' . TienIch::vn_to_str($product['product_title']) . '-' . $product['product_id'] ?>"><img class="img-fluid d-block mx-auto" src="<?php echo BASE_URL . '/upload/' . explode(',', $product['product_image'])[0] ?>"></a></div>
                                        <div class="product-name"><a href="<?php echo BASE_URL . '/san-pham/' . TienIch::vn_to_str($product['product_title']) . '-' . $product['product_id'] ?>"><?php echo $product['product_title'] ?></a></div>
                                        <div class="about">

                                            <div class="price">
                                                <h3><?php echo number_format($price, 0, '', ',');  ?>đ</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        include ROOT_DIR . '/src/views/user/pagination.php';
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

<?php
include ROOT_DIR . '/src/views/user/foot.php';
?>