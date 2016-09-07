<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;
use yii\controllers\TagController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'title',
            'content:ntext',
            'update_time:datetime',
            'status',            

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
             
            ['class' => 'yii\grid\ActionColumn' ,


                'template'  => '{view}{delete}',
                  'urlCreator' => function ($action, $model, $key, $index) 
                        {
                             if ($action === 'view')
                             {
                               $url = 'index.php?r=post/view&id='.$model->id;
                                return $url;
                             }
                              if ($action === 'delete')
                             {
                               $url = 'index.php?r=post/delete&id='.$model->id;
                                return $url;
                             }
                             
                        }],
       ], 
    ]); ?>
</div>
