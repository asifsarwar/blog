<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\Comment;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
          
             
       $searchModel = new PostSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy(['create_time' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 5,
             ],
        ]);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUserindex()
    {
        $searchModel = new PostSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy(['create_time' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 5,
             ],
        ]);


        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$postcomments = Comment::find()->joinWith('lookup')->where(['post_id' => $id, 'type' => 'CommentStatus'])->all();
        $postcomments = new ActiveDataProvider([
            'query' => Comment::find()->joinWith('lookup')->where(['post_id' => $id])->andWhere(['type' => 'CommentStatus']),
            'pagination' => [
                'pageSize' => 5,
             ],
        ]);
        //print_r($postcomments);
        //exit;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'postcomments' => $postcomments
        ]);
    }

    public function actionUserview($id)
    {
        //$postcomments = Comment::find()->joinWith('lookup')->where(['post_id' => $id, 'type' => 'CommentStatus'])->all();
    
        $postcomments = new ActiveDataProvider([
            'query' => Comment::find()->where(['post_id' => $id])->where(['status' => '2']),
            'pagination' => [
                'pageSize' => 5,
             ],
        ]);
        //print_r($postcomments);
        //exit;
        return $this->render('userview', [
            'model' => $this->findModel($id),
            'postcomments' => $postcomments
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         
             
        $model = new Post();
        date_default_timezone_set('Asia/Karachi');
        $model->create_time = date('Y-m-d H:i:s');
        $model->update_time = $model->create_time;
        $model->author_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*$model->save();
            $er = $model->getErrors();
            print_r($er);
            exit;*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       
        $model = $this->findModel($id);
        $model->update_time = date('Y-m-d H:i:s');
        $model->author_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {          
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
