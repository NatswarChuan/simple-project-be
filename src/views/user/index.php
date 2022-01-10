<!-- Trang chủ -->

<?php
include ROOT_DIR . '/src/views/user/head.php';
?>

<body>
    <?php
    include ROOT_DIR . '/src/views/user/navbar.php';
    ?>

    <main class="page">
        <section class="clean-block slider">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Brand</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                        mattis vitae leo.</p>
                </div>
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner">
                        <div class="carousel-item active"><img class="w-100 d-block" src="<?php echo BASE_URL ?>/assets/img/scenery/image1.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="<?php echo BASE_URL ?>/assets/img/scenery/image4.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="<?php echo BASE_URL ?>/assets/img/scenery/image6.jpg" alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                </div>
                <div class="block-heading">
                    <h2 class="text-info">Sản phẩm HOT</h2>
                </div>
                <div class="products">
                    <div class="row no-gutters">
                        <?php
                        foreach ($productsHot as $product) {
                            $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                        ?>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="clean-product-item">
                                    <div class="image"><a href="<?php echo BASE_URL . '/san-pham/' . TienIch::vn_to_str($product['product_title']) . '-' . $product['product_id'] ?>"><img class="img-fluid d-block mx-auto" src="<?php echo  explode(',', $product['product_image'])[0] ?>"></a></div>
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
                </div>
                <div class="block-heading">
                    <h2 class="text-info">Sản phẩm SALE</h2>
                </div>
                <div class="products">
                    <div class="row no-gutters">
                        <?php
                        foreach ($productsSale as $product) {
                            $price = $product['product_price'] * (100 - $product['product_sale']) / 100;
                        ?>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="clean-product-item">
                                    <div class="image"><a href="<?php echo BASE_URL . '/san-pham/' . TienIch::vn_to_str($product['product_title']) . '-' . $product['product_id'] ?>"><img class="img-fluid d-block mx-auto" src="<?php echo  explode(',', $product['product_image'])[0] ?>"></a></div>
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
                </div>
            </div>
        </section>
    </main>
</body>

<?php
include ROOT_DIR . '/src/views/user/foot.php';
?>