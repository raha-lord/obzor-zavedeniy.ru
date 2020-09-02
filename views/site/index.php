<?php include ROOT.'/views/layouts/header.php'  ?>
<main>
    <div class="body">
        <div class="content-banner">
            Рекламный баннер
        </div>
        <div class="content-box">
            <div class="bests-box">
                <?php foreach ($categoryList as $category) :?>
                <?php if ($category['mother_id']==0) :?>
                <div class="mid-menu restaurants-menu">
                    <div class="mid-menu-logo"><img src="/template/img/food-logo.png"></div>
                    <h2><?php echo $category['name'] ?></h2>
                    <ul>
                        <?php foreach ($subcatList as $subCat) :?>
                        <?php if ($subCat['mother_id']==$category['id']):?>
                        <li><a href="/category/<?php echo $subCat['id'] ?>"><?php echo $subCat['name'] ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="grid-content-list">
                    <?php foreach ($contentList as $content ) :?>
                    <?php if ($content['mather_cat_id']==$category['id'] ):?>
                            <div class="grid-content-item">
                                <a href="/content/<?php echo $content['id']?>">
                                    <div class="grid-content-item-info">
                                        <h2><?php  echo $content['title']?></h2>
                                        <p><?php echo $content['one_info']?></p>
                                    </div>
                                </a>
                                <img src="<?php echo Content::getContentImageById($content['id']) ?>">
                            </div>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php include ROOT.'/views/layouts/footer.php'?>
