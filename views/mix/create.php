<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<script src="/js/mix.js?v=<?php echo time(); ?>"></script>
<table id="manage-panel">
    <tr>
        <td>
            <input id="track-title" type="text" value="Untitled">
            <button id="save-mix" type="button" class="btn btn-primary">Save mix</button>
        </td>
        <td>
            <?php echo Html::dropDownList(
                'current-collection',
                null,
                [0 => 'Random samples'] + Yii::$app->base->getUserCollectionsList(),
                ['class' => 'form-control current-collection', 'id' => 'current-collection']
            ); ?>
            <button id="save-mix" type="button" class="btn btn-primary">Select collection</button>
        </td>
    </tr>
</table>
<div class="wrapper mt20px">
    <div id="samples" class="draggable-items border p5px">
        <?php if (!empty($samples)): ?>
            <?php foreach ($samples as $chunk): ?>
                <?php foreach ($samples as $chunk): ?>
                    <?php echo Html::tag('div', $sample->title, [
                        'style' => 'background:#' . Yii::$app->base->getRandomCssColor(),
                        'data-id' => $sample->id,
                        'data-title' => $sample->title,
                        'class' => 'item btn btn-default'
                    ]); ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="mt20px">
        <table id="manage-panel">
            <tr>
                <td>
                    <button id="add-track" type="button" class="btn btn-success">Add track</button>
                    <button id="start-stop" type="button" class="btn btn-primary" data-state="1">Start</button>
                </td>
                <td>
                    <span class="timer" id="timer">
                        <span id="minutes">00</span>:
                        <span id="seconds">00</span>:
                        <span id="miliseconds">00</span>
                    </span>
                </td>
            </tr>
        </table>
        <div id="track-pointer-wrapper">
            <div id="track-pointer"></div>
        </div>
        <div id="tracks">
            <?php for ($i = 0; $i < 1; $i++): ?>
                <div class="track">
                    <div class="controls">
                        <button class="remove confirm" type="button">R</button>
                        <button class="solo" type="button">S</button>
                        <button class="mute" type="button">M</button>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
