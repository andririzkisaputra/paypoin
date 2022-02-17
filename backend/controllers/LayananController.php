<?php

namespace backend\controllers;

use Yii;
use common\models\FileUpload;
use common\models\Layanan;
use backend\models\LayananForm;
use backend\models\LayananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * LayananController implements the CRUD actions for LayananForm model.
 */
class LayananController extends Controller
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
     * Lists all Kategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LayananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Layanan model.
     * @param integer $layanan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($layanan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($layanan_id),
        ]);
    }

    /**
     * Creates a new Layanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LayananForm();

        if ($model->load(Yii::$app->request->post())) {
            $layanan_id = $model->simpan();
            if ($layanan_id) {                
                return $this->redirect(['view', 'layanan_id' => $layanan_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Layanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $layanan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($layanan_id)
    {
        $model = $this->findModel($layanan_id);
        $code  = strtolower($model->nama_layanan);
        $code  = str_replace(" ", "-", $code);
        $model->code = $code;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'layanan_id' => $model->layanan_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Layanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $layanan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($layanan_id)
    {
        $query = Layanan::find()
            ->joinWith('produks')
            ->joinWith('tagihan')
            ->where(['layanan.layanan_id' => $layanan_id])->count();
        $model = $this->findModel($layanan_id);
        if ($query) {
            $model->is_delete = Layanan::STATUS_DELETED;
            $model->update();
            return $this->redirect(['index']);
        } else {
            $model->delete();
            return $this->redirect(['index']);
        }

    }

    public function actionImage($session_upload_id)
    {
        $model = FileUpload::findOne(['session_upload_id' => $session_upload_id]);
        $imgFullPath = Yii::getAlias('@common/uploads/layanan/'.$model->file_name);
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', ['image/jpeg']);
        $response->format = Response::FORMAT_RAW;

        if (!is_resource($response->stream = fopen($imgFullPath, 'r'))) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }

        return $response->send();
    }
    
    /**
     * Finds the Layanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Layanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Layanan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
