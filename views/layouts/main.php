<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <noscript>
        <meta http-equiv="refresh" content="4; URL=/badbrowser.html">
    </noscript>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo Yii::$app->request->absoluteUrl; ?>"/>
    <meta property="og:site_name" content="SAMPLEMIX"/>
    <meta property="fb:admins" content="100021679943795"/>
    <meta property="fb:app_id" content="1012546728888531"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="canonical" href="<?php echo Yii::$app->request->absoluteUrl; ?>"/>
    <base href="<?php echo Yii::$app->request->hostInfo; ?>">
    <title><?php echo $this->title; ?></title>
    <?php echo Html::csrfMetaTags(); ?>
    <?php $this->head(); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <?php if (!empty(Yii::$app->params['is_production'])): ?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', '', 'auto');
            ga('send', 'pageview');
        </script>
    <?php endif; ?>
    <script type="text/javascript">
        Global = {
            baseUrl : '<?php echo Yii::$app->homeUrl; ?>',
            staticFilesVersion : '<?php echo time(); ?>',
            addSampleToCollection: '<?php echo Url::toRoute(['ajax/add-sample-to-collection']); ?>',
            setCollection: '<?php echo Url::toRoute(['ajax/set-collection']); ?>',
            removeSampleFromCollection: '<?php echo Url::toRoute(['ajax/remove-sample-from-collection']); ?>'
        };
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => 'SAMPLEMIX',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top header-navbar',
            ],
        ]
    ); ?>
    <?php echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Samples', 'url' => ['/sample/index'], 'visible' => !Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'Mixes', 'url' => ['/mix/index'], 'visible' => !Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'Samples Collections', 'url' => ['/collection/index'], 'visible' => !Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'Login', 'url' => ['/user/login'], 'visible' => Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'Register', 'url' => ['/user/register'], 'visible' => Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'My Profile', 'url' => ['/user/profile'], 'visible' => !Yii::$app->user->isGuest],
                '<li class="divider">|</li>',
                ['label' => 'Logout (' . Yii::$app->base->getUserNickname(Yii::$app->user->id) . ')',
                    'url' => ['/user/logout'],
                    'linkOptions' => ['data-method' => 'post'], 'visible' => !Yii::$app->user->isGuest],
            ],
        ]
    );
    NavBar::end();
    ?>
    <?php echo Breadcrumbs::widget([
                                       'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                   ]) ?>
    <?php echo $content; ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="author-credits">
            <div class="center">
                The beautifull icons provided by
                <a class="underline" target="_blank" href="https://www.flaticon.com">Flaticon</a> and
                <a class="underline" target="_blank" href="http://fontawesome.io/">Fontawesome</a>
            </div>
            <div class="center">
                Powered by <a class="underline yii-link" target="_blank" href="http://www.yiiframework.com/">Yii2 Framework</a>
            </div>
            <div class="center pt10">
                Copyright © 2017. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody(); ?>
<script src="/libs/jquery-ui/jquery-ui.js"></script>
<script src="/libs/underscore-min.js"></script>
<script src="/libs/backbone-min.js"></script>
<script src="/libs/fontawesome.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js"></script>
<script src="/js/init.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php $this->endPage(); ?>
