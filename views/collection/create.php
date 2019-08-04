<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\gii\CollectionGii */

$this->title = 'Create Collection';
$this->params['breadcrumbs'][] = ['label' => 'Collection Giis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-gii-create">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo Html::a('Collections', ['index'], ['class' => 'btn btn-primary']); ?>
    </p>
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
