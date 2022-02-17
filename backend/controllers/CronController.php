<?php

namespace backend\controllers;

use Yii;
use common\models\Cron;
use common\models\Product;
use common\models\Category;
use common\components\PayPoinApi;
use common\components\Library;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\CronForm;

/**
 * CronController.
 */
class CronController extends Controller
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
     * Index.
     * @return mixed
     */
    public function actionPaypoin()
    {
        $data   = [];
        $array  = [];
        $cron = Cron::findAll(['c1' => 'PAYPOIN']);
        foreach ($cron as $key => $value) {
            $insertProduct = 0;
            $updateProduct = 0;
            $insertCategory = 0;
            $updateCategory = 0;

            $produk = (new PayPoinApi)->getHarga(['kode_produk' => $value->code]);
            
            foreach ($produk as $k => $v) {
                
                $model  = Product::findOne(['code' => $v->kode]);
                $info   = preg_replace("/H2H/","", $v->produk);
                $info   = preg_replace("/[^0-9]/","", $info);
                $harga  = preg_replace("/Rp. /","", $v->harga);
                $harga  = preg_replace("/,/","", $harga);
                $harga  = preg_replace("/-/","", $harga);


                $c2     = preg_replace("/-/"," ", $value->c2);

                $array  = [
                    'type'        => $value->c2,
                    'code'        => $v->kode,
                    'name'        => $v->produk,
                    'note'        => ucwords($c2.' '.strtolower($value->c3).' '.$v->harga),
                    'fund'       => 0,
                    'fee'         => 0,
                    'bill'        => 0,
                    'price'       => (int)$harga,
                    'price_basic' => (int)$harga,
                    'status'      => 'available',
                    'brand'       => $value->c3,
                    'category'    => $value->c4,
                    'provider'    => $value->c1,
                ];

                if ($value->c2 == 'pulsa-reguler' && (new Library)->getHargaPulsa($info) && $harga >= '5000') {
                    if ($model) {
                        if ((new CronForm)->updateProduct($model, $array)) {
                            $updateProduct++;
                        }
                    } else {
                        if ((new CronForm)->saveProduct($array)) {
                            $insertProduct++;
                        }
                    }
                }

                if ($value->c2 == 'paket-data') {
                    if ($model) {
                        if ((new CronForm)->updateProduct($model, $array)) {
                            $updateProduct++;
                        }
                    } else {
                        if ((new CronForm)->saveProduct($array)) {
                            $insertProduct++;
                        }
                    }
                }
            }

            $model  = Category::findOne([
                'type' => $value->c2,
                'code' => $value->c3,
                'real' => $value->c5
            ]);

            if ($model) {
                if ((new CronForm)->updateCategory($model, $value)) {
                    $updateCategory++;
                }
            } else {
                if ((new CronForm)->saveCategory($value)) {
                    $insertCategory++;
                }
            }

            $data['Product'][] = [
                'name' => $value->c5.' '.$value->c3,
                'insert'   => $insertProduct,
                'update'   => $updateProduct
            ];
            
            $data['Category'][] = [
                'name' => $value->c5.' '.$value->c3,
                'insert'   => $insertCategory,
                'update'   => $updateCategory
            ];

        }

        print_r(json_encode($data));
    }

   /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $produk_id
     * @return FileUpload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($produk_id)
    {
        if (($model = Produk::findOne($produk_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
