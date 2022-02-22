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
            <div class="row">
                <div class="col-sm-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'code_bill',
                            [
                                'label' => 'Nama',
                                'value' => $model->costumer_name,
                                'contentOptions' => ['class' => 'bg-red', 'hidden' => ($model->costumer_name ? false : true)],
                                'captionOptions' => ['tooltip' => 'Tooltip', 'hidden' => ($model->costumer_name ? false : true)],
                            ],
                            [
                                'label' => 'Token',
                                'value' => $model->note,
                                'contentOptions' => ['class' => 'bg-red', 'hidden' => ($model->note ? false : true)],
                                'captionOptions' => ['tooltip' => 'Tooltip', 'hidden' => ($model->note ? false : true)],
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
