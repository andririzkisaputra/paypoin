<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->nama_produk;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Ubah', ['update', 'produk_id' => $model->produk_id], ['class' => 'btn btn-success']) ?>
                <?= 
                    Html::a('Hapus Produk', ['delete', 'produk_id' => $model->produk_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to change this status item?',
                            'method' => 'post',
                        ],
                    ]) 
                ?>
            </p>
            <div class="row">
                <div class="col-sm-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'produk_id',
                            'code_layanan',
                            'kode_produk',
                            'nama_produk',
                            [
                                'label' => 'Harga Produk',
                                'value' => (new Library)->getFormatRupiah($model->harga_produk),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Penurunan',
                                'value' => (new Library)->getFormatRupiah($model->harga_markdown),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Kenaikan',
                                'value' => (new Library)->getFormatRupiah($model->harga_markup),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
    </div>

</div>
