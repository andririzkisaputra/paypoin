<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'real',
                    'headerOptions' => ['class' => 'text-center'],
                    'label' => 'Ketegori',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'name',
                    'headerOptions' => ['class' => 'text-center'],
                    'label' => 'Nama',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => '{detail}{ubah}{hapus}',
                    'header'   => 'Aksi',
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
