<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Mix */

$this->title = 'Update Mix: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mix-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
