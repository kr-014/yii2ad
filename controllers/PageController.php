<?php

namespace app\controllers;

use app\services\PageService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class PageController extends Controller
{
    private $service;
    
    public function __construct(
        $id,
        $module,
        PageService $service,
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
                'only' => ['logout'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'page' => $this->service->getHomePage()
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionView($id)
    {
        if (null === $page = $this->service->getPageById($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $this->render('view', [
            'page' => $page
        ]);
    }
}
