<?php

namespace frontend\modules\tagihanlistrik\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Tagihan;
use common\models\Layanan;
use common\models\Produk;
use frontend\modules\tagihanlistrik\models\TagihanForm;
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
            $tagihan_id = $model->simpan();
            if ($tagihan_id) {
                sleep(7);
                return $this->redirect(['tagihan?tagihan_id='.$tagihan_id]);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }

        $result['modelLayanan'] = 'tagihan-listrik';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($kode_tagihan)
    {

        $model  = $this->findModel(['kode_tagihan' => $kode_tagihan]);
        $produk = Produk::find()->where([
            'code_layanan' => $model->code_layanan,
            'jenis'      => '2'
        ])->one();
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

    public function actionTagihan($tagihan_id){
        
        $model  = $this->findModel($tagihan_id);
        $modelLayanan = Produk::findOne([
            'code_layanan' => $model->code_layanan,
            'jenis'      => '2'
        ]);
        $status = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $model->kode_produk, 
            'kode_tagihan' => $model->kode_tagihan, 
            'dest'         => $model->dest, 
        ]);

        $check = preg_match('/sukses/i', $status);
        if ($check) {
            $array                 = explode('/',$status);            
            $nama                  = str_replace('NAMA:','',$array[3]);
            $tagihan               = str_replace('Ref: Tagihan RP','',$array[1]);
            if ($modelLayanan->harga_markup) {
                $tagihan = $tagihan+$modelLayanan->harga_markup;
            } elseif ($modelLayanan->harga_markdown) {
                $tagihan = $tagihan-$modelLayanan->harga_markdown;
            }
            $tagihan               = $tagihan+$modelLayanan->harga_produk;
            $model->nama_pelanggan = (string)$nama;
            $model->total_harga    = (string)$tagihan;
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Lakukan Pembayaran');            
        } else {
            $model->status_tagihan = '4';
            $model->save();
            \Yii::$app->getSession()->setFlash('error', 'Tagihan Belum Tersedia Untuk Bulan Ini/Sudah Lunas');
        }

        
        $result['model'] = $model;
        $result['nama']  = $nama;
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
        if (($model = Tagihan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
