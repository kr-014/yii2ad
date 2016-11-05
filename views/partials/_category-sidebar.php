<?php
use yii\helpers\Url;
?>
<?php if(!empty($menu)) : ?>
<div class="panel panel-default">
    <div class="list-group">
        <?php foreach($menu as $item) : ?>
            <a href="<?= Url::to($item['url']) ?>" class="list-group-item <?= $item['active'] ? 'active' : '' ?>"><?= $item['label'] ?></a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

