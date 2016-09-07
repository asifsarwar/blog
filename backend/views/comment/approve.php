<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Lookup;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = 'Approve Commnet';
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
            //'status',
            'email:email',
            'url:url',

        ],
    ]) ?>
    <div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(
                        ArrayHelper::map(Lookup::find()->all(),'code','name'),
                        [
                            //'prompt' => 'Select Status',
                        
                        ]); ?> 

    
        <div class="form-group">
            
            <?= Html::submitButton('Satus' , ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
    

</div>
