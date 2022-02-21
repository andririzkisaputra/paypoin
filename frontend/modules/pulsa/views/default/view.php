<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
$this->title = $model->code_bill;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?php if ($model->status === 'menunggu pembayaran') : ?>
                    <?= Html::a('Bayar', ['bayar', 'code_bill' => $model->code_bill], ['class' => 'btn btn-success']) ?>
                <?php endif ?>
            </p>
            <div class="row">
                <div class="col-sm-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'code_bill',
                            [
                                'label' => 'Produk',
                                'value' => $model->name,
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Tagihan',
                                'value' => (new Library)->getFormatRupiah($model->price),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Status Tagihan',
                                'value' => $model->status,
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
