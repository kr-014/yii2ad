<?php

namespace app\controllers;

use app\services\BlogService;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class BlogController extends Controller
{
    private $service;
    
    public function __construct(
        $id,
        $module,
        BlogService $service,
        $config = array()
    ) {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($id)
    {
        if (null === $category = $this->service->getCategoryById($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $this->render('index', [
            'category' => $category,
            'posts' => $this->service->getPostsByCategory($category)
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionPost($id)
    {
        if (null === $post = $this->service->getPostById($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $this->render('post', [
            'post' => $post
        ]);
    }
}
