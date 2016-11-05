<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = $category->title;
$this->params['breadcrumbs'] = [
    $this->title
];
$this->registerMetaTag(['name' => 'description', 'content' => $category->meta_description], 'description');
?>
<div class="blog-page-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <?= ListView::widget([
                    'dataProvider' => $posts,
                    'itemView' => '_post',
                    'itemOptions' => ['class' => 'single-blog'],
                    'summary' => false,
                ]); ?>
            </div>
            <div class="col-sm-3 col-xs-12 side">
                <?= $this->render('../partials/_category-sidebar', [
                    'menu' => \rokorolov\parus\menu\api\Menu::navItems('blog_menu')
                ]) ?>
            </div>
        </div>
    </div>
</div>