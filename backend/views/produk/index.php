<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\Category;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title    = 'Produk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Produk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'code',
                [
                    'attribute' => 'brand',
                    'filter' => ArrayHelper::map(Product::find()->groupBy('brand')->all(), 'brand', 'brand')
                ],
                'name',
                'note',
                'status',
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'price',
                    'headerOptions' => ['class' => 'text-center'],
                    'label' => 'Harga Produk',
                    'contentOptions' => ['class' => 'text-center'],
                    'value'=>function($data){
                    return (new Library)->getFormatRupiah($data->price);
                    },
                ],
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'updated_at',
                    'headerOptions' => ['class' => 'text-center'],
                    'label' => 'Tanggal Simpan',
                    'contentOptions' => ['class' => 'text-center'],
                    'value'     => function ($data) {
                        return (new Library)->getDate($data->updated_at);
                    }
                ],
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => '{detail}',
                    // 'template' => '{detail}{ubah}{hapus}',
                    'buttons'  => [
                        'detail' => function ($url, $model) {
                            return Html::a('Detail', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                                'class' => 'btn btn-info btn-sm'
                            ]);
                        },
                        'ubah' => function ($url, $model) {
                            return Html::a('Ubah', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                                'class' => 'btn btn-success btn-sm'
                            ]);
                        },
                        'hapus' => function ($url, $model) {
                            return Html::a('Hapus', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to change this status item?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'detail') {
                            $url ='view?id='.$model->id;
                            return $url;
                        } elseif ($action === 'ubah') {
                            $url ='update?id='.$model->id;
                            return $url;
                        } elseif ($action === 'hapus') {
                            $url ='delete?id='.$model->id;;
                            return $url;
                        }
                    }
                ],
            ],
        ]);
    ?>

</div>
