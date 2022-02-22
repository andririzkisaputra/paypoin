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
    public function actionView($code_bill)
    {
        $PayPoinApi = new PayPoinApi;
        $model      = $this->findModel(['code_bill' => $code_bill]);
        $status     = $PayPoinApi->getStatusTransaksi([
            'kode_produk'  => $model->code, 
            'kode_tagihan' => $code_bill, 
            'dest'         => $model->data, 
        ]);
        if (preg_match('/sukses/i', $status)) {
            if (preg_match('/Timeout Order/i', $status)) {
                $model->status = 'gagal';
                $model->save();
            } else {
                if (preg_match('/sukses/i', $status)) {
                    $model->status = 'sukses';
                    $model->save();
                } 

                if (preg_match('/proses/i', $status)) {
                    $model->status = 'proses';
                    $model->save();
                }
            }
        } else {         
            if (!preg_match('/TIDAK ADA transaksi/i', $status)) {
                $model->status = 'gagal';
                $model->save();
            }   
        }
        // $check = preg_match('/sukses/i', $status);
        // if ($check) {
        //     $array = explode('/',$status);
        //     if ($model->layanan_id == '4') {
        //         $model->serial_number = ($array[1]) ? str_replace('Ref: ','',$array[1]) : null;
        //     } elseif ($model->layanan_id == '6') {
        //         $model->nama_pelanggan = ($array[1]) ? str_replace('Ref: ','',$array[1]) : null;
        //     }
        //     $model->status_tagihan = '2';
        //     $model->save();
            
        // } else {
        //     // $check = preg_match('/status=43/i', $status);
        //     // print_r($status);
        //     // exit;
        //     // if ($check) {
        //     $model->status_tagihan = '4';
        //     $model->save();
        //     // }
        // }
        return $this->render('view', [
            'model'  => $model,
            'status' => $status,
        ]);
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
