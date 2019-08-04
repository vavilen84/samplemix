<?php
namespace app\controllers;

use app\components\Console;
use app\models\db as Models;
use Yii;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'samples' => Models\Sample::find()->all()
        ]);
    }

    public function actionContact()
    {
        $this->title = 'Contact Us';
        $this->layout = 'wide';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, your message was not send. Please try later or write us via skype.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
}
