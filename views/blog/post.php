<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $post->title;
$this->params['breadcrumbs'] = [$this->title];
$this->registerMetaTag(['name' => 'description', 'content' => $post->meta_description], 'description');
?>
<div class="post-page-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <article class="single-blog">
                    <?php if (!empty($post->image)) : ?>
                        <div class="post-image">
                            <?= Html::img($post->image_large_src, ['class' => 'img-responsive', 'alt' => $post->title, 'title' => $post->title]) ?>
                        </div>
                    <?php endif; ?>
                    <h2 class="post-title">
                        <?= $post->title; ?>
                    </h2>

                    <div class="article-meta">
                        <span class="post-date"><i class="fa fa-clock-o"></i><?= $post->published_at_date_long; ?></span> |
                        <span class="post-cat">
                            <i class="fa fa-eye"></i>
                            <?= Html::a($post->category->title, ['category/show', 'id' => $post->category->id], ['title' => $post->category->title]) ?>
                        </span>
                    </div>

                    <div class="post-content">
                        <div class="entry-content">
                            <?= $post->fulltext; ?>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>