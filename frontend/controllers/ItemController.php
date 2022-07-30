<?php

namespace frontend\controllers;

use Yii;
use app\models\Item;
use app\models\ItemSearch;
use common\models\Statistic;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\CustomComponent;
/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$this->actionRecord(Yii::$app->request);
        Yii::$app->CustomComponent->trigger(CustomComponent::EVENT_TRIGGER);
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->CustomComponent->trigger(CustomComponent::EVENT_TRIGGER);
        //$this->actionRecord(Yii::$app->request);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewPicture($nama)
    {
        $file = Yii::getAlias('@backend/web/ptr/' .$nama);
        return Yii::$app->response->sendFile($file, NULL, ['inline' => TRUE]);
        //$this->actionRecord(Yii::$app->request);
        // return $this->render('view', [
        //      'model' => $this->findModel($id),
        // ]);
    }


 private function actionRecord($param){
        $stats = new Statistic();
        $stats->access_time = date('Y-m-d H:i:s');
        $stats->user_ip = $param->userIP;
        // var_dump($stats->user_ip); die();
        $stats->user_host = $param->hostInfo;
        $stats->path_info = $param->pathInfo;
        $stats->query_string = $param->queryString;
        $stats->save();
    }




    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
