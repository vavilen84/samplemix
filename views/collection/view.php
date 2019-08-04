<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\gii\CollectionGii */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Collection Giis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="/js/collection.js?v=<?php echo time(); ?>"></script>
<div class="collection-gii-view">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <p>
        <?php echo Html::a('Collections', ['index'], ['class' => 'btn btn-primary']); ?>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger confirm']); ?>
    </p>
    <?php echo DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'id',
                'title',
            ],
        ]
    ); ?>
    <?php if (!empty($samples)): ?>
        <table class="table table-striped table-bordered detail-view mt20px">
            <?php foreach ($samples as $sample): ?>
                <tr>
                    <td>
                        <?php echo $sample->title; ?>
                    </td>
                    <td>
                        <audio class="top3px" controls loop controlslist="nodownload">
                            <source src="<?php echo Yii::$app->base->getMp3Url($sample->id); ?>">
                        </audio>
                    </td>
                    <td>
                        <button class="btn btn-danger remove-sample-from-collection"
                                data-sample_id="<?php echo $sample->id; ?>" class="btn btn-danger">Remove
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
<input id="collection-id" type="hidden" value="<?php echo $model->id; ?>">
