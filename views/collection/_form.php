<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\CollectionGii */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="collection-gii-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord
                ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
