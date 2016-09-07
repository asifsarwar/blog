<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Lookup;
/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

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
            //'id',
            'content:ntext',
           [
            'attribute' => 'status',
            'label' => 'Status',
            'value' => call_user_func(function($model){                

                //print_r('model status '.$model->status);
                $lookup = Lookup::find()->where(['code' => $model->status])->One();
                //print_r($lookup);
                //exit;
                return $lookup->name;
                }, $model),
              
            ],
            
            'author',
            'email:email',
            'url:url',
            //'post_id',
        ],
    ]) ?>

</div>
