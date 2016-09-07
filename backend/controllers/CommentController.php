<?php

namespace backend\controllers;

use Yii;
use common\models\Comment;
use common\models\CommentSearch;
use common\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
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
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApprove($id = null)
    {
       
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            echo "Comment status value - ".$model->status."<br/>";
            echo "Comment author value - ".$model->author."<br/>";
                 
       
            $model->update();
             echo "Updated comment status value - ".$model->status."<br/>";
            //exit;
            //print_r($model);
            
            $postcomments = new ActiveDataProvider([
                'query' => Comment::find()->where(['post_id' => $model->post_id]),
                'pagination' => [
                'pageSize' => 5,
                 ],
            ]);
  

        return $this->render('//post/view', [
            'id' => $model->post_id, 
            'model' => Post::find()->where(['id' => $model->post_id])->One(),
            'postcomments' => $postcomments,] 
            ); 
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
           return $this->render('approve', [
            'model' => $model,
        ]);
        }
        
    }
    public function actionApprovecomment($id,$status)
    {

        echo "Status value - ".$status."<br/>";
        $comment = Comment::findOne($id);
        echo "Comment status value - ".$comment->status."<br/>";
        $comment->status = $status;
        $comment->update();
        echo "Updated comment status value - ".$comment->status."<br/>";
        exit;
        $postcomments = new ActiveDataProvider([
            'query' => Comment::find()->where(['post_id' => $comment->post_id]),
            'pagination' => [
                'pageSize' => 5,
             ],
        ]);
  

        return $this->render('//post/view', [
            'id' => $comment->post_id, 
            'model' => $model = Post::find()->where(['id' => $comment->post_id])->One(),
            'postcomments' => $postcomments,] 
            ); 
        //Yii::$app()->runController('post/view/id/'.$comment->post_id);
    }
    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Comment model.
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
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
