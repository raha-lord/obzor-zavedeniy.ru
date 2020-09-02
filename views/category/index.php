<?php include ROOT.'/views/layouts/header.php'  ?>
<body>
    <div class="body">
        <div class="content-banner">
            Рекламный баннер
        </div>
        <div class="mid-menu restaurants-menu">
            <div class="mid-menu-logo"><img src="/template/img/food-logo.png"></div>
            <?php foreach ($categoryList as $category) :?>
                <?php if ($category['id'] == $cat_id) :?>
                    <h2><?php echo $category['name'] ?></h2>
                <?php endif ;?>
            <?php endforeach; ?>
            <ul>
                <?php foreach ($categoryList as $category) :?>
                    <?php if ($category['mother_id']==$cat_id):?>
                        <li><a href="/category/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="content-box">
            <div class="contentList">
                <?php foreach ($contentList as $contentItem) :?>
                    <a href="/content/<?php echo $contentItem['id']?>">
                        <div class="contentList-item">
                            <img src="<?php echo Content::getContentImageById($contentItem['id']); ?>">
                            <div class="contentList-item-info">
                                <h2><?php echo $contentItem['title']?></h2>
                                <span ><?php echo $contentItem['one_info']?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>
        </div>
        <?php echo $pagination->get(); ?>
        <?php include ROOT.'/views/module/pagination.php' ?>
        <?php include ROOT.'/views/module/recommendation.php'  ?>
    </div>
</body>
<?php include ROOT.'/views/layouts/footer.php'  ?>
