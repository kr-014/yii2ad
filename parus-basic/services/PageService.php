<?php

namespace app\services;

use rokorolov\parus\page\repositories\PageReadRepository;
use rokorolov\parus\admin\theme\widgets\statusaction\helpers\Status;
use rokorolov\parus\page\helpers\Settings;
use Yii;

/**
 * PageService
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PageService
{
    private $pageReadRepository;
    
    public function __construct(
        PageReadRepository $pageReadRepository
    ) {
        $this->pageReadRepository = $pageReadRepository;
    }
    
    public function getHomePage()
    {
        return $this->pageReadRepository->where(['p.status' => Status::STATUS_PUBLISHED])->setPresenter('app\presenters\PagePresenter')->findFirstBy('p.home', Settings::homePageYesSign());
    }
    
    public function getPageById($id)
    {
        return $this->pageReadRepository->where(['p.status' => Status::STATUS_PUBLISHED])->setPresenter('app\presenters\PagePresenter')->findFirstBy('p.id', $id);
    }
}
