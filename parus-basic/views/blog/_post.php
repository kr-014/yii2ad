<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<article>
    <?php if (!empty($model->image)) : ?>
        <div class="post-image">
            <a href="<?= Url::to(['post/show', 'id' => $model->id]) ?>">
                <?= Html::img($model->image_large_src, ['class' => 'img-responsive', 'alt' => $model->title, 'title' => $model->title]); ?>
            </a>
        </div>
    <?php endif; ?>
    <h2 class="post-title">
        <?= Html::a($model->title, ['post/show', 'id' => $model->id]); ?>
    </h2>

    <div class="article-meta">
        <span class="post-date"><i class="fa fa-clock-o"></i><?= $model->published_at_date_long; ?></span> |
        <span class="post-cat">
            <i class="fa fa-eye"></i><?= Html::a($model->category_title, ['category/show', 'id' => $model->category_id], ['title' => $model->category_title]) ?>
        </span>
    </div>

    <div class="post-content">
        <?= $model->introtext; ?>
    </div>

    <div class="post-action clearfix">
        <?= Html::a(Yii::t('app', 'Read more') . ' <i class="fa fa-long-arrow-right"></i>', ['post/show', 'id' => $model->id], ['class' => 'btn btn-default btn-sm pull-right', 'rel' => 'nofollow']); ?>
    </div>
</article>