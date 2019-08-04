<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\UserGii */

$this->title = 'Update Profile';
?>
<div class="user-gii-update">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <div class="user-gii-form">
        <?php $form = ActiveForm::begin(); ?>
        <input id="user-email" name="User[email]" hidden>
        <input id="user-nickname" name="User[nickname]" hidden>
        <input id="user-password" name="User[password]" hidden>
        <?php echo $form->field($model, 'nickname')->textInput(['maxlength' => true]); ?>
        <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]); ?>
        <?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true]); ?>
        <div class="form-group">
            <?php echo Html::submitButton(
                $model->isNewRecord
                    ? 'Create'
                    : 'Update', [
                    'class' => $model->isNewRecord
                        ? 'btn btn-success'
                        : 'btn btn-primary'
                ]
            ); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
