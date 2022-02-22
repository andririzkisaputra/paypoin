<?php

namespace frontend\modules\telkom\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Trx;
use common\models\Product;
use frontend\modules\telkom\models\TagihanForm;
use common\components\PayPoinApi;

/**
 * Default controller for the `pulsa` module
 */
class DefaultController extends Controller
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
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new TagihanForm();
        if ($model->load(Yii::$app->request->post())) {
            $id = $model->simpan();
            if ($id) {
                return $this->redirect(['tagihan?id='.$id]);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }

        $result['modelLayanan'] = 'telkom';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($code_bill)
    {
        $data       = $this->findModel(['code_bill' => $code_bill]);
        $status     = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $data->code,
            'kode_tagihan' => $code_bill,
            'dest'         => $data->data,
        ]);
        $check      = preg_match('/GAGAL/i', $status);
        if ($check == '0') {
            $check  = preg_match('/Timeout Order/i', $status);
            if ($check == '0') {
                $check = preg_match('/sukses/i', $status);
                if ($check) {
                    // $countMin  = strpos($status, "Saldo: ");
                    // $countMax  = strpos($status, "TrxId");
                    // $status    = substr($status, 0, $countMax);
                    // $status    = substr($status, $countMin, $countMax);
                    // $status    = preg_replace("/Saldo: /","", $status);
                    // $status    = preg_replace("/,/","", $status);
                    \Yii::$app->getSession()->setFlash('success', 'Sukses');
                    $data->status = 'sukses';
                    $data->save();
                } else {
                    // $countMin  = strpos($status, " - ");
                    // $countMax  = strpos($status, " = ");
                    // $status    = substr($status, 0, $countMax);
                    // $status    = substr($status, $countMin, $countMax);
                    // $status    = preg_replace("/ - /","", $status);
                    // $status    = preg_replace("/,/","", $status);
                    \Yii::$app->getSession()->setFlash('success', 'Proses');
                    $data->status = 'proses';
                    $data->save();
                }
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal');
                $data->status = 'gagal';
                $data->save();
            }
        } else {            
            \Yii::$app->getSession()->setFlash('error', 'Gagal');
            $data->status = 'gagal';
            $data->save();
        }
        

        return $this->goHome();
    }

    public function actionTagihan($id){
        
        $model  = $this->findModel($id);
        if ($model->status === 'menunggu pembayaran') {
            \Yii::$app->getSession()->setFlash('success', 'Lakukan Pembayaran');            
        } else {
            \Yii::$app->getSession()->setFlash('error', 'Tagihan Belum Tersedia Untuk Bulan Ini/Sudah Lunas');
        }

        $result['model'] = $model;
        return $this->render('view', $result);

    }

    // public function actionTagihan($tagihan_id){
        
    //     $model  = $this->findModel($tagihan_id);
    //     $status = (new PayPoinApi)->getTransaksi([
    //         'kode_produk'  => $model->kode_produk, 
    //         'kode_tagihan' => $model->kode_tagihan, 
    //         'dest'         => $model->dest, 
    //     ]);

    //     $check = preg_match('/sukses/i', $status);
    //     if ($check) {
    //         $array   = explode('/',$status);            
    //         $nama    = str_replace('ref: ','',$array[2]);
    //         $tagihan = str_replace('Ref: Tagihan RP','',$array[1]);
    //         $model->nama_pelanggan = (string)$nama;
    //         $model->total_harga    = (string)$tagihan;
    //         $model->save();
    //         \Yii::$app->getSession()->setFlash('success', 'Lakukan Pembayaran');            
    //     } else {
    //         $model->status_tagihan = '4';
    //         $model->save();
    //         \Yii::$app->getSession()->setFlash('error', 'Tagihan Belum Tersedia Untuk Bulan Ini/Sudah Lunas');
    //     }

        
    //     $result['model'] = $model;
    //     $result['nama']  = (isset($nama)) ? $nama : null;
    //     return $this->render('view', $result);

    // }

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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
