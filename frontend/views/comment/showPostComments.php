<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-showPostComments">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'content:ntext',
            //'status',
            'create_time:datetime',
            'author',
            // 'email:email',
            // 'url:url',
            // 'post_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
