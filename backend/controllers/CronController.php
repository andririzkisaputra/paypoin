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
        $cron = Cron::find()->where(['and',
            ['c1' => 'PAYPOIN'],
            ['!=', 'c3', 'PPOB'],
        ])->all();
        foreach ($cron as $key => $value) {
            $insertProduct = 0;
            $updateProduct = 0;
            $insertCategory = 0;
            $updateCategory = 0;
            if ($value->c3 == 'PPOB') {
                print_r($value->c3);
                exit;
            }
            $produk = (new PayPoinApi)->getHarga(['kode_produk' => $value->code]);
            
            foreach ($produk as $k => $v) {
                
                $model  = Product::findOne(['code' => $v->kode, 'brand' => $value->c3]);
                $info   = preg_replace("/[^0-9]/","", $v->kode);
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
                } elseif ($value->c2 != 'pulsa-reguler') {
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
     * Index.
     * @return mixed
     */
    public function actionPaypoinPpob()
    {
        $data   = [];
        $array  = [];
        $cron = Cron::find()->where(['and',
            ['c1' => 'PAYPOIN'],
            ['=', 'c3', 'PPOB'],
        ])->all();

        foreach ($cron as $key => $value) {

            $insertProduct = 0;
            $updateProduct = 0;
            $insertCategory = 0;
            $updateCategory = 0;

            $produk = (new PayPoinApi)->getHarga(['kode_produk' => $value->code]);
            
            foreach ($produk as $k => $v) {
                $model  = Product::findOne(['code' => $v->kode, 'brand' => $value->c3]);
                $info   = preg_replace("/[^0-9]/","", $v->kode);
                $harga  = preg_replace("/Rp. /","", $v->harga);
                $harga  = preg_replace("/,/","", $harga);
                $harga  = preg_replace("/-/","", $harga);

                $c2     = preg_replace("/-/"," ", $value->c2);

                $array  = [
                    'type'        => strtolower($value->c2),
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

                $ppob = false;
                
                if (preg_match('/PDAM/i', $v->produk)) {
                    $ppob = 'PDAM';
                    $value->c2 = strtolower($ppob);
                    $value->c3 = $ppob;
                    $value->c5 = $ppob;
                } 

                if (preg_match('/SPEEDY/i', $v->produk)) {
                    $ppob = 'TELKOM';
                    $value->c2 = strtolower($ppob);
                    $value->c3 = $ppob;
                    $value->c5 = $ppob;
                }
                
                if (preg_match('/PLN POSTPAID BY STAND/i', $v->produk)) {
                    $ppob = 'TAGIHAN LISTRIK';
                    $value->c2 = str_replace(' ', '-', strtolower($ppob));
                    $value->c3 = $ppob;
                    $value->c5 = $ppob;
                } 
                
                if (preg_match('/FINANCE/i', $v->produk)) {
                    $ppob = 'ANGSURAN';
                    $value->c2 = strtolower($ppob);
                    $value->c3 = $ppob;
                    $value->c5 = $ppob;
                } 

                $array['note']     = 0;
                if ($ppob) {
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

                    $array['type']     = $value->c2;
                    $array['brand']    = $ppob;
                    $array['category'] = ($value->code === 'INQ') ? 'CEK '.$ppob : $ppob;

                    $model  = Product::findOne(['code' => $v->kode, 'brand' => $array['brand']]);
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
