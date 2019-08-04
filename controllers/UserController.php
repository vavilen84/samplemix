<?php
namespace app\controllers;

use app\models\form as Models;
use app\models\db as DbModels;
use Yii;

class UserController extends BaseController
{
    public function actionRegister()
    {
        $model = new Models\RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->register()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        if (($model = DbModels\User::findOne(Yii::$app->user->id)) === null) {
            throw new NotFoundHttpException('User doesnt exists');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        } else {
            $model->password = null;
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogin()
    {
        $model = new Models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if(Yii::$app->user->logout()){
            return $this->goHome();
        }
    }
}