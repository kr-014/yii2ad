<?php

namespace app\presenters;

use rokorolov\parus\admin\base\BasePresenter;
use rokorolov\helpers\Html;
use Yii;

/**
 * PostPresenter
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PostPresenter extends BasePresenter
{
    public function published_at_date()
    {
        return Yii::$app->formatter->asDate($this->wrappedObject->published_at);
    }
    
    public function published_at_date_long()
    {
        return Yii::$app->formatter->asDate($this->wrappedObject->published_at, 'long');
    }
    
    public function image_large_src()
    {
        if (!empty($this->wrappedObject->image)) {
            return Yii::getAlias('@web/uploads/post/' . $this->wrappedObject->id . '/' . $this->wrappedObject->image . '-large.jpg');
        }
        return null;
    }
}
