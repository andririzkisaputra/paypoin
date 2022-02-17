<?php

namespace frontend\modules\games\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Tagihan;
use common\models\Layanan;
use common\models\Produk;
use common\models\KategoriGame;
use common\models\FileUpload;
use frontend\modules\games\models\TagihanForm;
use common\components\PayPoinApi;
use yii\web\Response;

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
        $modelGame = KategoriGame::findAll(['is_delete' => '1']);
        $result['modelGame']    = $modelGame;
        return $this->render('index', $result);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionListHarga($game)
    {
        $model = new TagihanForm();
        if ($model->load(Yii::$app->request->post())) {
            $tagihan_id = $model->simpan();
            if ($tagihan_id) {
                $result['model'] = $this->findModel($tagihan_id);
                return $this->render('view', $result);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }
        $games = KategoriGame::findOne([
            'kategori_game' => $game,
            'is_delete' => '1'
        ]);

        $modelProduk = Produk::findAll([
            'kategori_game' => $games,
        ]);

        $result['model']       = $model;
        $result['modelProduk'] = $modelProduk;
        $result['games']       = $games;
        return $this->render('list-harga', $result);
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
        $model = Tagihan::findOne([
            'kode_tagihan' => $kode_tagihan,
        ]);
        if ($check) {
            if ($model->status_tagihan == '0') {
                $model->status_tagihan = '4';
                $model->save();
            }
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

    // public function actionTagihan($tagihan_id){
        
    //     $model  = $this->findModel($tagihan_id);
    //     $modelLayanan = Produk::findOne([
    //         'code_layanan' => $model->code_layanan,
    //         'jenis'        => '2'
    //     ]);

    //     if ($modelLayanan) {
    //         if ($modelLayanan->harga_markup) {
    //             $tagihan = $tagihan+$modelLayanan->harga_markup;
    //         } elseif ($modelLayanan->harga_markdown) {
    //             $tagihan = $tagihan-$modelLayanan->harga_markdown;
    //         }
    //         $tagihan               = $tagihan+$modelLayanan->harga_produk;
    //         $model->total_harga    = (string)$tagihan;
    //         $model->save();
    //         \Yii::$app->getSession()->setFlash('success', 'Lakukan Pembayaran');            
    //     } else {
    //         $model->status_tagihan = '4';
    //         $model->save();
    //         \Yii::$app->getSession()->setFlash('error', 'Tagihan Belum Tersedia Untuk Bulan Ini/Sudah Lunas');
    //     }

        
    //     $result['model'] = $model;
    //     $result['nama']  = $nama;
    //     return $this->render('view', $result);

    // }

    public function actionImage($session_upload_id)
    {
        $model = FileUpload::findOne(['session_upload_id' => $session_upload_id]);
        $imgFullPath = Yii::getAlias('@common/uploads/kategori-game/'.$model->file_name);
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', ['image/png']);
        $response->format = Response::FORMAT_RAW;

        if (!is_resource($response->stream = fopen($imgFullPath, 'r'))) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }

        return $response->send();
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
