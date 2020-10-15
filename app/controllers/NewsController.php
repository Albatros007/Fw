<?php

namespace app\controllers;

use app\models\News;
use vendor\core\Fw;

class NewsController extends BaseController
{
    public function __construct() 
    {
        //$this->useDb = false;
        parent::__construct();
    }
    
    public function indexAction()
    {
        $news = Fw::$app->cache->get('news');
        
        if (empty($news)) {
            $news = News::getAllNews();
            Fw::$app->cache->set('news', $news);
        }
        
        $this->render->setData(compact('news'));
    }

    public function soloAction($id)
    {
        $news = News::getNews($id);
         //$this->render->setLayout(false);
        $this->render->setData(compact('news'));
    }
    
    public function soloAjaxAction()
    {
        $id = $_POST['id'];
        $news = News::getNews($id);
        //$this->render->setData(compact('news'));
        $this->render->ajax(compact('news'));
        
    }

    public function calendarAction($date)
    {
            echo __METHOD__;
            echo '<br />';
            echo $date;
    }

    public function listAction()
    {
            //echo __METHOD__;
    }
}
