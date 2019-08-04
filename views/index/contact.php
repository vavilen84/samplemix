<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<script>
    $(document).ready(function () {
        $('#contact-form').append('<input type="hidden" value="1" name="ContactForm[hidden]">');
        $('.banner').click(function () {
            $('html, body').animate({
                scrollTop: $("#landing").offset().top
            }, 500);
        });
    });
</script>
<div class="contact-us-content body-content container">
    <div class="site-contact">
        <h1 class="center uppercase">Contact Us</h1>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <span class="success email-success">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </span>
        <?php else: ?>
            <div class="form">
                <div class="row">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="fl">
                        <?php echo $form->field($model, 'name')->textInput() ?>
                        <?php echo $form->field($model, 'email') ?>
                        <?php echo $form->field($model, 'subject') ?>
                        <?php echo $form->field($model, 'body')->textarea(['rows' => 10]) ?>
                        <div class="form-group">
                            <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>
                    </div>
                    <div class="fr">
                        <span><strong>E-Mail:</strong> no-reply@example.com</span><br>
                        <span><strong>Skype:</strong> live:skype</span>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
