<div class="recommendation-block ">
    <p class="block-name">Рекомендуем</p>
    <div class="recommendation-list">
        <?php foreach ($recommendationList as $content ) :?>
            <div class="recommendation-item">
                <div class="recommendation-info">
                    <a href="/content/<?php echo $content['id']?>">
                        <h2><?php  echo $content['title']?></h2>
                        <p><?php echo $content['one_info']?></p>
                    </a>
                </div>
                <a href="/content/<?php echo $content['id']?>"></a>
                <img src="<?php echo Content::getContentImageById($content['id']) ?>">
            </div>
        <?php endforeach;?>
    </div>
</div>