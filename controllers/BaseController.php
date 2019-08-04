<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\HttpException;

class BaseController extends Controller
{
    public $keywords = '';
    public $description = '';
    public $title = '';
    public $ogImage = '';

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
        $this->setDefaults();
    }

    protected function setDefaults()
    {
        $this->layout = 'fixed';
        $this->ogImage = Yii::$app->request->hostInfo . '/images/logo.png';
    }
}
