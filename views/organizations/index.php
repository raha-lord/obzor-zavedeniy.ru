<?php include ROOT.'/views/layouts/header.php'  ?>
<body>
<div class="body">
    <div class="content-banner">
        Рекламный баннер
    </div>
    <div class="content-box">
        <a href="/organization/<?php echo $org_item['id']?>">
            <div class="content-item-org-info">
                <img src="<?php echo Organization::getOrgImgById($org_item['id']) ?>">
                <div class="content-item-org-info-text">
                    <h2><?php echo $org_item['name'] ?></h2>
                    <p><?php echo $org_item['description'] ?></p>
                </div>
            </div>
        </a>
        <div class="contentList">
            <?php foreach ($contentList as $contentItem) :?>
                <div class="contentList-item">
                    <a href="/content/<?php echo $contentItem['id']?>">
                        <img src="<?php echo Content::getContentImageById($contentItem['id']); ?>">
                        <div class="contentList-item-info">
                            <h2><?php echo $contentItem['title']?></h2>
                            <p class="one-info"><?php echo $contentItem['one_info']?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <?php echo $pagination->get(); ?>
</div>
</body>
<?php include ROOT.'/views/layouts/footer.php'  ?>
