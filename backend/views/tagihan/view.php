<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->kode_tagihan;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-sm-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'kode_tagihan',
                            [
                                'label' => 'Nama Pelanggan',
                                'value' => $model->nama_pelanggan,
                                'contentOptions' => ['class' => 'bg-red', 'hidden' => ($model->nama_pelanggan ? false : true)],
                                'captionOptions' => ['tooltip' => 'Tooltip', 'hidden' => ($model->nama_pelanggan ? false : true)],
                            ],
                            [
                                'label' => 'Token',
                                'value' => $model->serial_number,
                                'contentOptions' => ['class' => 'bg-red', 'hidden' => ($model->serial_number ? false : true)],
                                'captionOptions' => ['tooltip' => 'Tooltip', 'hidden' => ($model->serial_number ? false : true)],
                            ],
                            [
                                'label' => 'Tagihan',
                                'value' => (new Library)->getFormatRupiah($model->total_harga),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Status Tagihan',
                                'value' => (new Library)->getStatusTagihan($model->status_tagihan),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Tanggal Transaksi',
                                'value' => (new Library)->getDate($model->updated_at),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
    </div>

</div>
