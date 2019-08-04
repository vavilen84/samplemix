<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\gii\CollectionGii */

$this->title = 'Update Collection Gii: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Collection Giis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collection-gii-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
