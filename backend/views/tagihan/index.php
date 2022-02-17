<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Kategori;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagihan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-tagihan-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5><?= Html::encode($saldo) ?></h5>

    <p>
        <!-- <?= Html::a('Create Tagihan', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?= 
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ], 
                'code_bill',
                'data',
                'status',
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'price',
                    'headerOptions' => ['class' => 'text-center'],
                    'label' => 'Total Harga',
                    'contentOptions' => ['class' => 'text-center'],
                    'value'=>function($data){
                        return 'Rp '.number_format($data['price']);
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
                    'buttons'  => [
                        'detail' => function ($url, $model) {
                            return Html::a('Detail', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                                'class' => 'btn btn-info btn-sm'
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'detail') {
                            $url ='view?code_bill='.$model->code_bill;
                            return $url;
                        }
            
                    }
                ],
             ],
        ]);
    ?>

</div>
