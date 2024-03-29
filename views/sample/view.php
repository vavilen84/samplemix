<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Mix */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-view">
    <h1><?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'title',
            'json:ntext',
            'status',
        ],
    ]); ?>
</div>
