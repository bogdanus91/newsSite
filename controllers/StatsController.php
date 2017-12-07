<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Clicks;
use yii\data\Pagination; 

class StatsController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $clicks=Clicks::find()->all();
             
        
        return $this->render('index',['clicks'=>$clicks]);
    }

}
