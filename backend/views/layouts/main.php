<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
//$bundle = yiister\gentelella\assets\Asset::register($this);
DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>


<div class="wrapper">
<?php echo $this->render('\admintheme\header'); ?>
<?php echo $this->render('\admintheme\leftslider'); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo $this->render('\admintheme\headernavbar'); ?>
    <section class="content">
        <?= $content ?>
    </section>
    
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
