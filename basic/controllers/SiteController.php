<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\GPoints;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
		$model = new GPoints();
		
		//вставить данные если был метод POST
		if ($model->load(Yii::$app->request->post()) && $model->validate()){
			$command = Yii::$app->db->createCommand("insert into g_points(point_n, point_e, point_name) values({$model->point_n}, {$model->point_e}, '{$model->point_name}')");
			$command->execute();
			
			//очистить поля
			//$model = new GPoints();
			
			//эмуляция header("Location: $_SERVER[REQUEST_URI]"); - так правильнее
			$this->refresh();
		}
        return $this->render('index',['model' => $model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $query = Yii::$app->db->createCommand('select point_n, point_e, point_name from g_points order by point_id desc');
		$points = $query->queryAll();
		
        return $this->render('contact', ['points' => $points]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
