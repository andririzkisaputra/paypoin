<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Provinsi */

$this->title = 'Ubah Produk: ' . $model->nama_kota;
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_kota, 'url' => ['view', 'produk_id' => $model->kota_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="layanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>