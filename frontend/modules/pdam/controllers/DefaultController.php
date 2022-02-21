<?php

namespace frontend\modules\pdam\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Trx;
use common\models\Layanan;
use common\models\Produk;
use common\models\Provinsi;
use common\models\Kota;
use frontend\modules\pdam\models\TagihanForm;
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
        $result['modelLayanan'] = 'pdam';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($kode_tagihan)
    {

        $model          = $this->findModel(['kode_tagihan' => $kode_tagihan]);
        $produk_tagihan = Produk::findOne([
            'code_layanan' => $model->code_layanan,
            'kode_produk'  => $model->kode_produk,
            'is_delete'    => '1',
        ]);
        $produk = Produk::findOne([
            'code_layanan'  => $model->code_layanan,
            'kota_id'     => $produk_tagihan->kota_id,
            'jenis'       => '2',
            'is_delete'   => '1',
        ]);
        $status = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $produk->kode_produk,
            'kode_tagihan' => $kode_tagihan,
            'dest'         => $model->dest,
        ]);
        $check = preg_match('/sukses/i', $status);
        $model = Tagihan::findOne([
            'kode_tagihan' => $kode_tagihan,
        ]);
        if ($check) {
            if ($model->status_tagihan == '0') {
                $model->status_tagihan = '4';
                $model->kode_produk    = $produk->kode_produk;
                $model->save();
            }
            \Yii::$app->getSession()->setFlash('success', 'Berhasil');
        } else {
            $check = preg_match('/proses/i', $status);
            if ($check) {
                if ($model->status_tagihan == '0') {
                    $model->status_tagihan = '1';
                    $model->kode_produk    = $produk->kode_produk;
                    $model->save();
                }
                \Yii::$app->getSession()->setFlash('success', 'Sedang di proses');
            } else {
                if ($model->status_tagihan <= '1' ) {
                    $model->kode_produk    = $produk->kode_produk;
                    $model->status_tagihan = '4';
                    $model->save();
                }
                \Yii::$app->getSession()->setFlash('error', $status);    
            }
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
