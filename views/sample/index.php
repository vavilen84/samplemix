<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\db as Models;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mixes';
$this->params['breadcrumbs'][] = $this->title . '/ MIXES';
?>
<script src="/js/samples.js?v=<?php echo time(); ?>"></script>
<div class="mix-index">
    <p>
        <?php echo Html::a('Create Collection', ['collection/create'], ['class' => 'btn btn-primary']); ?>
    </p>
    <?php echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'headerOptions' => ['style' => 'width:70px;'],
                    'attribute' => 'sampleId',
                    'label' => 'ID',
                    'value' => 'id',
                    'filter' => true,
                ],
                [
                    'attribute' => 'title',
                    'label' => 'Title',
                    'value' => 'title',
                    'filter' => true,
                ],
                [
                    'headerOptions' => ['style' => 'width:70px;'],
                    'attribute' => 'tempo',
                    'label' => 'Tempo',
                    'value' => 'tempo',
                    'filter' => true,
                ],
                [
                    'headerOptions' => ['style' => 'width:70px;'],
                    'attribute' => 'key',
                    'label' => 'Key',
                    'value' => function ($model) {
                        return Yii::$app->base->getKeyTitle($model->key);
                    },
                    'filter' => Yii::$app->base->getKeys(),
                ],
                [
                    'attribute' => 'tags',
                    'label' => 'Tags',
                    'value' => function ($model) {
                        return Yii::$app->base->getDividedTags($model->tags);
                    },
                    'filter' => Yii::$app->base->getTagsList(),
                ],
                [
                    'headerOptions' => ['style' => 'width:320px;'],
                    'label' => 'MP3 Controls',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<audio controls loop><source src="' . Yii::$app->base->getMp3Url($model->id) . '"></audio>';
                    },
                ],
                [
                    'headerOptions' => ['style' => 'width:70px;'],
                    'label' => 'WAV',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<a download href="' . Yii::$app->base->getWavUrl($model->id) . '" class="btn btn-primary">Download</a>';
                    },
                ],
                [
                    'headerOptions' => ['style' => 'width:290px;'],
                    'label' => 'Add to collection',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::dropDownList(
                            'select-collection',
                            null,
                            Yii::$app->base->getUserCollectionsList(),
                            ['class' => 'form-control', 'data-collection_sample_id' => $model->id]
                        )
                        . '<a class="btn btn-primary add-to-collection-btn" data-sample_id="' . $model->id . '">Add</a>';
                    },
                ]
            ],
        ]
    ); ?>
</div>