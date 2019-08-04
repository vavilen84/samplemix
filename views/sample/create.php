<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<script src="/js/mix.js?v=<?php echo time(); ?>"></script>
<table id="manage-panel">
    <tr>
        <td>
            <button id="add-track" type="button" class="btn btn-success">Add track</button>
            <button id="reset" type="button" class="btn btn-primary">Reset</button>
            <button id="start-stop" type="button" class="btn btn-primary" data-state="1">Start</button>
        </td>
        <td>
            <span class="timer" id="timer">
                <span id="minutes">00</span>:
                <span id="seconds">00</span>:
                <span id="miliseconds">00</span>
            </span>
        </td>
        <td>
            <span id="zoom">
                <span id="current-zoom" data-zoom="100">100%</span>
                 <button id="decrease-zoom" type="button" class="btn btn-primary">-</button>
                <button id="increase-zoom" type="button" class="btn btn-primary">+</button>
            </span>
        </td>
        <td>
            <?php if(!Yii::$app->user->isGuest): ?>
                <button id="save-mix" type="button" class="btn btn-primary">Save mix</button>
                <input id="track-title" type="text" value="Untitled">
            <?php endif; ?>
        </td>
    </tr>
</table>
<div class="wrapper mt20px">
    <div class="fl w20per border p5px">
        <div class="draggable-items">
            <?php foreach ($samples as $sample): ?>
                <?php $color = Yii::$app->base->getRandomCssColor(); ?>
                <?php echo Html::tag('div', $sample->title, [
                    'style' => 'background:#' . $color,
                    'data-mp3_url' => Yii::$app->base->getMp3Url($sample->url),
                    'data-url' => $sample->url,
                    'data-color' => $color,
                    'data-id' => $sample->id,
                    'data-title' => $sample->title,
                    'class' => 'item btn btn-default'
                ]); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="fr w75per relative">
        <div id="track-pointer-wrapper">
            <div id="track-pointer" data-position="0"></div>
        </div>
        <div id="tracks">
        </div>
    </div>
    <div class="clear"></div>
</div>