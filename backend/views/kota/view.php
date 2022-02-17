<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;
use common\components\Library;
use common\models\Provinsi;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->nama_kota;
$this->params['breadcrumbs'][] = ['label' => 'Kota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Ubah', ['update', 'kota_id' => $model->kota_id], ['class' => 'btn btn-success']) ?>
                <?= 
                    Html::a('Hapus Produk', ['delete', 'kota_id' => $model->kota_id], [
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
                            'kota_id',
                            [
                                'label' => 'Provinsi',
                                'value' => Provinsi::findOne(['provinsi_id' => $model->provinsi_id])->nama_provinsi,
                                'contentOptions' => ['class' => 'bg-red'],
                                'captionOptions' => ['tooltip' => 'Tooltip'],
                            ],
                            'nama_kota',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
    </div>

</div>
