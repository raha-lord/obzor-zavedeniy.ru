<?php include ROOT . '/views/layouts/header.php' ?>
<main>
    <div class="body">
        <div class="content-banner">
            Рекламный баннер
        </div>
        <div class="mid-menu restaurants-menu">
            <div class="mid-menu-logo"><img src="/template/img/food-logo.png"></div>
            <?php foreach ($categoryList as $category) :?>
                <?php if ($category['id'] == $contentItem['category_id']) :?>
                    <h2><?php echo $category['name'] ?></h2>
                <?php endif ;?>
            <?php endforeach; ?>
            <ul>
                <?php foreach ($categoryList as $category) :?>
                    <?php if ($category['mother_id']==$contentItem['category_id']):?>
                        <li><a href="/category/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="content-box">
            <div class="center-block">
                <div class="content-item">
                    <a href="/organization/<?php echo $contentItem['org_id']?>">
                        <div class="content-item-org-info">
                            <img src="<?php echo Organization::getOrgImgById($contentItem['org_id']) ?>">
                            <div class="content-item-org-info-text">
                                <h2><?php echo $org_item['name'] ?></h2>
                                <p><?php echo $org_item['description'] ?></p>
                            </div>
                        </div>
                    </a>
                    <div class="content-item-info">
                        <div><img src="<?php echo Content::getContentImageById($contentItem['id']) ?>"></div>
                        <div class="content-item-info-text">
                            <h3><?php echo $contentItem['title'];?></h3>
                            <p><?php echo $contentItem['one_info'];?></p>
                        </div>
                    </div>
                    <div class="content-item-description">
                        <p><?php echo $contentItem['content'];?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php include ROOT . '/views/module/recommendation.php' ?>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php' ?>
