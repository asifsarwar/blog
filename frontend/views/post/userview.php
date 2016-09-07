<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--     <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'content:ntext',
            'tags:ntext',

        ],
    ]) ?>

    <p>
        <?= Html::a('Create Post Comments', ['/comment/createpostcomment', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $postcomments,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           [
            'label'=>'Content',
             'attribute'=>'content',
             'format' => 'raw',

            
            ],
            [
             'label'=>'Posted On',
             'attribute'=>'create_time',
             'format' => 'date',
            ], 
            'author:ntext',
            'status',
            // 'email:email',
            // 'url:url',
            // 'post_id',
        /*['class' => 'yii\grid\ActionColumn' ,

        'template'  => '{view}{delete}',
                  'urlCreator' => function ($action, $model, $key, $index) 
                        {
                            //print_r($model);
                            //exit;
                            if ($action === 'view')
                             {
                               $url = 'index.php?r=comment/adminview&id='.$model->id;
                                return $url;
                             }
                             if ($action === 'delete')
                             {
                               $url = 'index.php?r=comment/admindelete&id='.$model->id;
                                return $url;
                             }
                             
                        }]*/
            
        ],
    ]); ?>

</div>
