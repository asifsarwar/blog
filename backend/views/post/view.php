<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = 'Posts Details';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
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

            'title',
            'content:ntext',
            'tags:ntext',
            
        ],
    ]) ?>
    <h1><?= Html::encode("Comments") ?></h1>
    <?= GridView::widget([
        'dataProvider' => $postcomments,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'content:ntext',
            'create_time:datetime',
            'author:ntext',
            'status',


        ['class' => 'yii\grid\ActionColumn' ,
        'buttons' => [

            'approve' => function ($url)
            {
                return Html::a('<span class="glyphicon glyphicon-flag" data-toggle="tooltip" title="approve" ></span>', $url);
            },       

        ],

        'template'  => '{approve}',
                  'urlCreator' => function ($action, $model2, $key, $index) 
                        {
                            //print_r($model);
                            //exit;
                            if ($action === 'approve')
                             {
                               $url = 'index.php?r=comment/approve&id='.$model2->id;
                                return $url;
                             }
                             
                        }]
            
        ],
    ]); ?>

</div>
