<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-showTagsPost">

    <h1><?php echo Html::encode($this->title);  ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


     <?php 

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'content:ntext',
              
            [
             'label'=>'Tags',
             'format'=>'raw',
             'value' => function($model){ 
                $url = "#";               
                $tags = Html::a($model->tags, $url, ['title' => 'Tag']);
                return $tags;
                }
            ],
            
        ],
    ]); ?>
</div>
