<?php include ROOT.'/views/layouts/header.php'  ?>
<div class="product-details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="product-details-content row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="zoomWrapper">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src="<?php echo News::getImageById($newsItem['id']); ?>" data-zoom-image="img/product/20.jpg" alt="big-1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Product info-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="product-details-conetnt">
                            <div class="product-name">
                                <h1> <?php echo $newsItem['title'] ?> </h1>
                            </div>
                            <div class="details-description">
                                <?php foreach ($categoryList as $cat) :?>
                                <?php if ($cat['id']==$newsItem['category_id']):?>
                                <p><a href="/category/<?php echo $newsItem['category_id'] ?>/"><?php echo $cat['name']; ?></a></p>
                                <?php endif;?>
                                <?php endforeach;?>
                                <p><?php echo $newsItem['content'] ?></p>
                                <p><a href="/organization/<?php echo $orgItem['id'] ?>/"><?php echo $orgItem['name'] ?></a></p>
                                <p><?php echo $newsItem['date'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-carousel-area section-top-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title"><h2>Похожие</h2></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="upsell-product-details-carousel">
                            <?php foreach ($newsByCategory as $news):?>
                            <div class="col-md-3">
                                <div class="single-product-item">
                                    <div class="single-product clearfix">
                                        <a href="/news/<?php echo $news['id'];?>">
                                                    <span class="product-image">
                                                        <img src="<?php echo News::getImageById($news['id']); ?>" alt="">
                                                    </span>
                                        </a>
                                    </div>
                                    <h2 class="single-product-name"><a href="#"><?php echo $news['title'];?></a></h2>
                                </div>
                            </div>
                            <?php endforeach; ?>
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
