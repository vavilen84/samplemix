<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\HttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [

        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {

        return $this->render('index', [

        ]);
    }

}
