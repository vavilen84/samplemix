<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Mix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mix-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'json')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
