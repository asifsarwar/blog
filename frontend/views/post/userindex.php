<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;
use yii\controllers\TagController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts in System';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'title',
            [
            //'content:ntext',
            'contentOptions' => ['style' => 'width:109px;'],
            'attribute' => 'content',
            'label'=>'Content',


             'format'=>'text',

            
            ],
            [
             'label'=>'Posted On',
             'attribute'=>'create_time',
             'format' => 'date'
            ],
            
            [
             'label'=>'Tags',
             'format'=>'raw',
             'value' => function($model){
                 
                 $str = explode(', ',$model->tags);
                 $tags = '';
                 foreach ($str as $tag) {
                    $url = "index.php?r=tag/showtagposts&id=".$tag;
                    $tags = $tags.Html::a($tag, $url, ['title' => 'Tag']).', ';
                 }
                 $ret = rtrim($tags, ", ");
                 return $ret;
             }
            ],
             
            ['class' => 'yii\grid\ActionColumn',

            /*'buttons' => [

            'showpostcomment' => function ($url)
            {
                return Html::a('<span class="glyphicon glyphicon-comment" data-toggle="tooltip" title="all comments" ></span>', $url);
            },
             'createpostcomment' => function ($url)
            {
                return Html::a('<span class="glyphicon glyphicon-flag" data-toggle="tooltip" title="add comments"></span>', $url);
            }

                        ],*/
            
            'template'  => '{showpostcomment}{createpostcomment}{view}',
                  'urlCreator' => function ($action, $model, $key, $index) 
                        {
                            //print_r($model);
                            //exit;
                           /* if ($action === 'showpostcomment')
                             {
                               $url = 'index.php?r=comment/showpostcomment&id='.$model->id;
                                return $url;
                             }
                             if ($action === 'createpostcomment')
                             {
                               $url = 'index.php?r=comment/createpostcomment&id='.$model->id;
                                return $url;
                             }*/
                             if ($action === 'view')
                             {
                               $url = 'index.php?r=post/userview&id='.$model->id;
                                return $url;
                             }
                             
                        }
            ],
       ], 
    ]); ?>
</div>
