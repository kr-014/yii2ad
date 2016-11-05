<?php

namespace app\services;

use app\dto\PostListDto;
use rokorolov\parus\blog\repositories\CategoryReadRepository;
use rokorolov\parus\blog\repositories\PostReadRepository;
use rokorolov\parus\admin\theme\widgets\statusaction\helpers\Status;
use rokorolov\parus\blog\helpers\Settings;
use rokorolov\parus\blog\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * BlogService
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class BlogService
{
    private $postReadRepository;
    private $categoryReadRepository;
    
    public function __construct(
        PostReadRepository $postReadRepository,
        CategoryReadRepository $categoryReadRepository
    ) {
        $this->postReadRepository = $postReadRepository;
        $this->categoryReadRepository = $categoryReadRepository;
    }
    
    public function getPostsByCategory($category)
    {
        $categoryChildrenIds = ArrayHelper::getColumn($this->categoryReadRepository->findChildrenIds($category->lft, $category->rgt), 'id');

        $query = $this->postReadRepository->make()
            ->select('p.id, p.title, p.category_id, p.slug, p.introtext, p.image, p.published_at, p.meta_title, p.meta_keywords, p.meta_description, c.title as category_title')
            ->andWhere(['in', 'p.category_id', $categoryChildrenIds])
            ->andWhere(['p.status' => Status::STATUS_PUBLISHED])
            ->leftJoin(Category::tableName() . ' c', 'p.category_id = c.id')
            ->orderBy('p.created_at DESC');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        $keys = [];
        $models = [];
        foreach($dataProvider->getModels() as $key => $data) {
            $keys[$key] = $data['id'];
            $models[$key] = Yii::createObject('app\presenters\PostPresenter', [new PostListDto($data)]);
        }
        $dataProvider->setKeys($keys);
        $dataProvider->setModels($models);
        
        return $dataProvider;
    }
    
    public function getCategoryById($id = null)
    {
        $id = $id ? $id : Settings::categoryRootId();
        
        return $this->categoryReadRepository->where(['c.status' => Status::STATUS_PUBLISHED])->skipPresenter()->findFirstBy('c.id', $id);
    }
    
    public function getPostById($id)
    {
        return $this->postReadRepository->where(['p.status' => Status::STATUS_PUBLISHED])->with(['category'])->setPresenter('app\presenters\PostPresenter')->findFirstBy('p.id', $id);
    }
}
