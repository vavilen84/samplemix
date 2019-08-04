<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Collection Giis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-gii-index">
    <p>
        <?php echo Html::a('Create Collection', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'label' => 'Samples count',
                    'value' => function ($model) {
                        return !empty($model->json) ? count(Json::decode($model->json)) : 0;
                    },
                ],
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
        ]
    ); ?>
</div>
