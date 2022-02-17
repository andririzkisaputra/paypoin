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
            <p>
                <?php if ($model->status_tagihan == '0') : ?>
                    <?= Html::a('Bayar', ['bayar', 'kode_tagihan' => $model->kode_tagihan], ['class' => 'btn btn-success']) ?>
                <?php endif ?>
            </p>
            <div class="row">
                <div class="col-sm-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'kode_tagihan',
                            [
                                'label' => 'Nama',
                                'value' => $nama,
                                'contentOptions' => ['class' => 'bg-red', 'hidden' => ($nama ? false : true)],
                                'captionOptions' => ['tooltip' => 'Tooltip', 'hidden' => ($nama ? false : true)],
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
                    ]) ?>
                </div>
            </div>
    </div>

</div>
