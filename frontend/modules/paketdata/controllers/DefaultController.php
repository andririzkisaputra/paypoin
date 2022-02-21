<?php

namespace frontend\modules\paketdata\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Trx;
use common\models\Produk;
use frontend\modules\paketdata\models\TagihanForm;
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

        $result['modelLayanan'] = 'paket-data';
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

    /**
     * Finds the Order model based on its primary key value.
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
