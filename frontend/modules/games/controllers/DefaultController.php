<?php

namespace frontend\modules\games\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Trx;
use common\models\Layanan;
use common\models\Produk;
use common\models\Product;
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
        $modelGame = Product::find()->where(['type' => 'games'])->groupBy('brand')->all();
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
            $id = $model->simpan();
            if ($id) {
                return $this->redirect(['tagihan?id='.$id]);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }
        $modelProduk = Product::findAll([
            'brand' => $game
        ]);

        $result['model']       = $model;
        $result['modelProduk'] = $modelProduk;
        return $this->render('list-harga', $result);
    }

    public function actionTagihan($id){
        
        $model  = $this->findModel($id);
        if ($model->status === 'menunggu pembayaran') {
            \Yii::$app->getSession()->setFlash('success', 'Lakukan Pembayaran');            
        } else {
            \Yii::$app->getSession()->setFlash('error', 'Gagal');
        }

        $result['model'] = $model;
        return $this->render('view', $result);

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
            $check  = preg_match('/Proses/i', $status);
            if ($check == '0') {
                // $check     = preg_match('/sukses/i', $status);
                // $countMin  = strpos($status, "Saldo: ");
                // $countMax  = strpos($status, "TrxId");
                // $status    = substr($status, 0, $countMax);
                // $status    = substr($status, $countMin, $countMax);
                // $status    = preg_replace("/Saldo: /","", $status);
                // $status    = preg_replace("/,/","", $status);
                \Yii::$app->getSession()->setFlash('success', 'Sedang Diproses');
                $data->status = 'proses';
                $data->save();
            } else {
                // $countMin  = strpos($status, " - ");
                // $countMax  = strpos($status, " = ");
                // $status    = substr($status, 0, $countMax);
                // $status    = substr($status, $countMin, $countMax);
                // $status    = preg_replace("/ - /","", $status);
                // $status    = preg_replace("/,/","", $status);
                \Yii::$app->getSession()->setFlash('success', 'Sukses');
                $data->status = 'sukses';
                $data->save();
            }
        } else {            
            \Yii::$app->getSession()->setFlash('error', 'Gagal');
            $data->status = 'gagal';
            $data->save();
        }
        

        return $this->goHome();
    }
 
    public function actionImage($img)
    {
        $imgFullPath = Yii::getAlias('@common/uploads/kategori-game/'.$img);
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', ['image/jpeg']);
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
        if (($model = Trx::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
