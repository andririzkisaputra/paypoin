<?php

namespace frontend\modules\tokenlistrik\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Tagihan;
use common\models\Produk;
use frontend\modules\tokenlistrik\models\TagihanForm;
use common\components\PayPoinApi;
use common\components\Library;

/**
 * Default controller for the `tokenlistrik` module
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

        $modelProduk = Produk::findAll(['code_layanan' => 'token-listrik', 'jenis' => '2']);
        foreach ($modelProduk as $key => $value) {
            $total_harga = $value->harga_produk;
            if ($value->harga_markup) {
                $total_harga = $total_harga+$value->harga_markup;
            } elseif ($value->harga_markdown) {
                $total_harga = $total_harga-$value->harga_markdown;
            }
            $value->total_harga   = $total_harga;
            $value->total_harga_f = (new Library)->getFormatRupiah($value->total_harga);
        }
        $result['modelProduk'] = $modelProduk;
        
        $result['modelLayanan'] = 'token-listrik';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($kode_tagihan)
    {
        $model  = $this->findModel(['kode_tagihan' => $kode_tagihan]);
        $status = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $model->kode_produk,
            'kode_tagihan' => $kode_tagihan,
            'dest'         => $model->dest,
        ]);
        $check = preg_match('/sukses/i', $status);
        if ($check) {     
            $array = explode('/',$status);
            $model->serial_number  = str_replace('Ref: ','',$array[1]);
            $model->status_tagihan = '2';
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Berhasil');
        } else {
            $check = preg_match('/proses/i', $status);
            if ($check) {
                if ($model->status_tagihan == '0') {
                    $model->status_tagihan = '1';
                    $model->save();
                }
                \Yii::$app->getSession()->setFlash('success', 'Sedang di proses');
            } else {
                if ($model->status_tagihan <= '1' ) {
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
        $produk = (new Produk)->findOne([
            'code_layanan' => $model->code_layanan, 
            'jenis'        => '1', 
        ]);
        $status = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $produk->kode_produk, 
            'kode_tagihan' => $model->kode_tagihan, 
            'dest'         => $model->dest, 
        ]);

        $check = preg_match('/sukses/i', $status);
        if ($check) {
            $array   = explode('/',$status);
            $nama = str_replace('Nama:','',$array[2]);
            $produk = (new Produk)->findOne([
                'code_layanan'  => $model->code_layanan, 
                'kode_produk' => $model->kode_produk, 
            ]);
            if ($produk->harga_markup) {
                $tagihan = $produk->harga_produk+$produk->harga_markup;
            } else {
                $tagihan = $produk->harga_produk-$produk->harga_markdown;
            }
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
        $result['nama']  = (isset($nama)) ? $nama : null;
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
