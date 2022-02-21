<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Upload Gambar', ['create-img', 'brand' => $model->brand, 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                <?= 
                    Html::a('Hapus Produk', ['delete', 'id' => $model->id], [
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
                            'id',
                            'type',
                            'code',
                            'name',
                            [
                                'label' => 'Harga Produk',
                                'value' => (new Library)->getFormatRupiah($model->price),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            [
                                'label' => 'Harga Produk Awal',
                                'value' => (new Library)->getFormatRupiah($model->price_basic),
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h4>Gambar</h4>
                        </div>
                        <div class="panel-body">
                            <?= $this->render('_gambar', ['model' => $model]) ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
