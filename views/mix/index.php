<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mixes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-index">
    <p>
        <?php echo Html::a('Create Mix', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('View', $url, ['class' => 'btn btn-primary']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Update', $url, ['class' => 'btn btn-success']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Delete', $url, ['class' => 'btn btn-danger']);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
