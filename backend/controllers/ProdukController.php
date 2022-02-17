<?php

namespace backend\controllers;

use Yii;
use common\models\Tagihan;
use common\models\FileUpload;
use common\models\Product;
use backend\models\ProdukForm;
use backend\models\ProdukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;

/**
 * ProdukController implements the CRUD actions for ProdukForm model.
 */
class ProdukController extends Controller
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    /**
     * Lists all Kategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produk model.
     * @param integer $produk_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($produk_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($produk_id),
        ]);
    }

    /**
     * Creates a new ProdukForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProdukForm();
        if ($model->load(Yii::$app->request->post())) {
            $produk_id = $model->simpan();
            if ($produk_id) {                
                return $this->redirect(['view', 'produk_id' => $produk_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Produk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $produk_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($produk_id)
    {
        $model = $this->findModel($produk_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'produk_id' => $model->produk_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $produk_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($produk_id)
    {
        $model = $this->findModel($produk_id);
        $query = Tagihan::find()
            ->where(['kode_produk' => $model->kode_produk])->count();
        if ($query) {
            $model->is_delete = Produk::STATUS_DELETED;
            $model->update();
            return $this->redirect(['index']);
        } else {
            $model->delete();
            return $this->redirect(['index']);
        }

    }


    public function actionGetKota() 
    {
        $model = (new Query)->from('kota')->where([
            'provinsi_id' => Yii::$app->request->post('provinsi_id')
        ])->orderBy(['nama_kota' => SORT_ASC])->all();
        $result['data']    = $model;
        $result['success'] = ($model) ? true : false;
        return json_encode($result);
    }
    
    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
