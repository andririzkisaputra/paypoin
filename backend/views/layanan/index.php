<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Kategori;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layanan-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Layanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                [
                    'attribute' => 'kategori_id',
                    'label' => 'Kategori',
                    'value' => 'kategori.nama_kategori',
                    'filter' => ArrayHelper::map(Kategori::find()->where(['is_delete' => '1'])->all(), 'kategori_id', 'nama_kategori')
                ],
                'nama_layanan',
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => '{detail}{ubah}{hapus}',
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
                            $url ='view?layanan_id='.$model->layanan_id;
                            return $url;
                        } elseif ($action === 'ubah') {
                            $url ='update?layanan_id='.$model->layanan_id;
                            return $url;
                        } elseif ($action === 'hapus') {
                            $url ='delete?layanan_id='.$model->layanan_id;;
                            return $url;
                        }
                    }
                ],
            ],
        ]);
    ?>

</div>
