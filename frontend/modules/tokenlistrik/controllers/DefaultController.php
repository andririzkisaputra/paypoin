<?php

namespace frontend\modules\tokenlistrik\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Trx;
use common\models\Product;
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
            $id = $model->simpan();
            if ($id) {
                return $this->redirect(['tagihan?id='.$id]);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }

        $modelProduk = Product::findAll(['type' => 'token-listrik', 'category' => 'umum']);

        $result['modelProduk'] = $modelProduk;
        
        $result['modelLayanan'] = 'token-listrik';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($code_bill)
    {
        $model  = $this->findModel(['code_bill' => $code_bill]);
        
        $status = (new PayPoinApi)->getTransaksi([
            'kode_produk'  => $model->code,
            'kode_tagihan' => $code_bill,
            'dest'         => $model->data,
        ]);

        $check = preg_match('/sukses/i', $status);
        if ($check) {     
            $array         = explode('/',$status);
            $model->note   = str_replace('Ref: ','',$array[1]);
            $model->status = 'terbayar';
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Berhasil');
        } else {
            $check = preg_match('/proses/i', $status);
            if ($check) {
                if ($model->status === 'menunggu pembayaran') {
                    $model->status = 'proses';
                    $model->save();
                }
                \Yii::$app->getSession()->setFlash('success', 'Sedang di proses');
            } else {
                $model->status = 'gagal';
                $model->save();
                \Yii::$app->getSession()->setFlash('error', 'Gagal');    
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
