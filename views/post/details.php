<?php include ROOT.'/views/layouts/header.php'  ?>
<div class="product-deails-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="product-details-content row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="zoomWrapper">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src="<?php echo News::getImageById($postItem['id']); ?>" data-zoom-image="img/product/20.jpg" alt="big-1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Product info-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="product-details-conetnt">
                            <div class="product-name">
                                <h1> <?php echo $postItem['title'] ?> </h1>
                            </div>
                            <div class="details-description">
                                <?php foreach ($categoryList as $cat) :?>
                                    <?php if ($cat['id']==$postItem['category_id']):?>
                                        <p>
                                            <a href="/category/<?php echo $postItam['category_id'] ?>/"><?php echo $cat['name']; ?></a>
                                        </p>
                                    <?php endif;?>
                                <?php endforeach;?>
                                <p>
                                    <?php echo $postItem['content'] ?>
                                </p>
                                <p>
                                    <a href="/organization/<?php echo $orgItem['id'] ?>/"><?php echo $orgItem['name'] ?></a>
                                </p>

                                <img src="/template/img/icon/social_link.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            </div>
        </div>
    </div>
</div>
<!--End of Product Details Area-->
<?php include ROOT.'/views/layouts/footer.php'?>
