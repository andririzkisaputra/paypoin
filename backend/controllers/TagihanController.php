<?php

namespace backend\controllers;

use Yii;
use common\models\Trx;
use common\components\PayPoinApi;
use backend\models\TagihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagihanController implements the CRUD actions for Tagihan model.
 */
class TagihanController extends Controller
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
     * Lists all Trx models.
     * @return mixed
     */
    public function actionIndex()
    {
        $saldo = (new PayPoinApi)->getSaldo();
        $saldo = (isset($saldo->pesan)) ? $saldo->pesan : '0';

        $searchModel  = new TagihanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $result['saldo']        = $saldo;
        $result['searchModel']  = $searchModel;
        $result['dataProvider'] = $dataProvider;
        return $this->render('index', $result);
    }

    /**
     * Displays a single Tagihan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tagihan_id)
    {
        $PayPoinApi = new PayPoinApi;
        $model      = $this->findModel($tagihan_id);
        $status     = $PayPoinApi->getStatusTransaksi([
            'kode_produk'  => $model->kode_produk, 
            'kode_tagihan' => $model->kode_tagihan, 
            'dest'         => $model->dest, 
        ]);
        $check = preg_match('/sukses/i', $status);
        if ($check) {
            $array = explode('/',$status);
            if ($model->layanan_id == '4') {
                $model->serial_number = ($array[1]) ? str_replace('Ref: ','',$array[1]) : null;
            } elseif ($model->layanan_id == '6') {
                $model->nama_pelanggan = ($array[1]) ? str_replace('Ref: ','',$array[1]) : null;
            }
            $model->status_tagihan = '2';
            $model->save();
            
        } else {
            // $check = preg_match('/status=43/i', $status);
            // print_r($status);
            // exit;
            // if ($check) {
            $model->status_tagihan = '4';
            $model->save();
            // }
        }
        return $this->render('view', [
            'model'  => $model,
            'status' => $status,
        ]);
    }

    /**
     * Creates a new Tagihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tagihan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tagihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tagihan_id)
    {
        $model = $this->findModel($tagihan_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tagihan_id' => $model->tagihan_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tagihan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tagihan_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tagihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tagihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trx::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
