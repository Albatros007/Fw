<?php

namespace app\models;

use \R;

class News extends \vendor\core\base\Model 
{
    protected static function tableName() 
    {
        return 'news';
    }
    
    public static function getAllNews() 
    {
        return R::findAll(self::tableName());    
    }
    
    public static function getNews($id) 
    {
        return R::findOne(self::tableName(), 'id = ?', [$id]);
    }
}
