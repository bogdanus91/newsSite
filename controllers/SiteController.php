<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\News;
use app\models\Clicks;
class SiteController extends Controller
{
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
     $news=News::find()->all();
    
        return $this->render('index',['news'=>$news]);
    }
    

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * @return string
     */
    public function actionClick()
    {
        $recordId=$_GET['id'];
     $clientIP=$_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}"));
		$country=$details->country;
   		$record = Clicks::find()
    		->where(['record_id' => $recordId])
    		->where(['country_code' => $country])
    		->one();
   		$userClicks='';
   		if (isset($_COOKIE['user_clicks']))
   		{
			$userClicks=$_COOKIE['user_clicks'];
		}
   		if (!$record)
   		{
		//if there were no clicks on current news post before just inserting the values
		$clicks=new Clicks();
		$clicks->unique_clicks=1;
		$clicks->click=1;
		$clicks->country_code=$country;
		$clicks->record_id=$recordId;
		$clicks->save();
			//setting up the cookie that will help us identify current user in future 
			setcookie('user_clicks',$recordId,time() + (86400 * 30));
		}
		else
		{
			
			//if the record existed before will check the client's cookie and update the record
		$otherClicks=$record['click']+1;
		
		if($userClicks!=$recordId)
		{
		$uniqueClicks=$record['unique_clicks']+1;
		$id=(int)$record['id'];
	$update->unique_clicks=$uniqueClicks;
	$update=Clicks::findOne(['id'=>$id]);
	
		$update->click=$otherClicks;
		$update->update();
		setcookie('user_clicks',$recordId,time() + (86400 * 30));
		}
	else
	{
		
		//$update=new Clicks;
	$id=(int)$record['id'];
	$update=Clicks::findOne(['id'=>$id]);
		$update->click=$otherClicks;
		$update->update();
		
	}
		}
		
		
	
    }
     /**
    
    
    * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
