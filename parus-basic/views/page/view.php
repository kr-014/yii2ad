<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = $page->title;
$this->params['breadcrumbs'] = [$this->title];
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta_description], 'description');

?>
<div class="page-view">
    <h1><?= Html::encode($page->title) ?></h1>
    <?= $page->content ?>
</div>
