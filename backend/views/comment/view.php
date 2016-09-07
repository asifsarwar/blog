<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Lookup;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'content:ntext',
            [
            'attribute'=>'status',
            'label' => 'Status',
            'filter'=>ArrayHelper::map(Lookup::find()->where(['type' => 'CommentStatus'])->all(),'code','name'),  // <-- right here
            ],
            'create_time:datetime',
            'author',
            'email:email',
            'url:url',
            'post_id',
        ],
    ]) ?>

</div>
