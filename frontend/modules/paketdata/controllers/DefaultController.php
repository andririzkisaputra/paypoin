<?php

namespace frontend\modules\paketdata\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Tagihan;
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
            $tagihan_id = $model->simpan();
            if ($tagihan_id) {
                $result['model'] = $this->findModel($tagihan_id);
                return $this->render('view', $result);
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Gagal Silahkan Tunggu Beberapa Saat Lagi');
            }
        }

        $result['modelLayanan'] = 'pulsa-reguler';
        $result['model']        = $model;
        return $this->render('index', $result);
    }

    public function actionBayar($kode_tagihan)
    {
        $data       = $this->findModel(['kode_tagihan' => $kode_tagihan]);
        $status     = (new PayPoinApi)->getTransaksi($data);
        $check      = preg_match('/GAGAL/i', $status);

        if ($check == '0') {
            $check  = preg_match('/Proses/i', $status);

            if ($check == '0') {
                $check     = preg_match('/sukses/i', $status);
                $countMin  = strpos($status, "Saldo: ");
                $countMax  = strpos($status, "TrxId");
                $status    = substr($status, 0, $countMax);
                $status    = substr($status, $countMin, $countMax);
                $status    = preg_replace("/Saldo: /","", $status);
                $status    = preg_replace("/,/","", $status);
                if ($check) {
                    \Yii::$app->getSession()->setFlash('success', 'Sukses');
                } else {
                    \Yii::$app->getSession()->setFlash('error', 'Gagal');
                } 
                $update = Tagihan::findOne([
                    'kode_tagihan' => $kode_tagihan,
                ]);
                if ($update->status_tagihan == '1' || $update->status_tagihan == '0') {
                    $update->status_tagihan = '2';
                    $update->save();
                }
            } else {
                $countMin  = strpos($status, " - ");
                $countMax  = strpos($status, " = ");
                $status    = substr($status, 0, $countMax);
                $status    = substr($status, $countMin, $countMax);
                $status    = preg_replace("/ - /","", $status);
                $status    = preg_replace("/,/","", $status);
                if ($check) {
                    \Yii::$app->getSession()->setFlash('success', 'Sedang Diproses');
                } else {
                    \Yii::$app->getSession()->setFlash('error', 'Gagal');
                }
                $update = Tagihan::findOne([
                    'kode_tagihan' => $kode_tagihan,
                ]);
                if ($update->status_tagihan == '0') {
                    $update->status_tagihan = '1';
                    $update->save();
                }
            }
        } else {
            $count  = strpos($status, "GAGAL.");
            if ($check) {
                \Yii::$app->getSession()->setFlash('error', $status);
            } else {
                \Yii::$app->getSession()->setFlash('success', substr($status, 0, $count));
            } 
            $update = Tagihan::findOne([
                'kode_tagihan' => $kode_tagihan,
            ]);
            if ($update->status_tagihan == '0') {
                $update->status_tagihan = '4';
                $update->save();
            }
        }
        

        return $this->goHome();
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
        if (($model = Tagihan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
