<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Layanan */

$this->title = 'Ubah Layanan: ' . $model->nama_layanan;
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_layanan, 'url' => ['view', 'layanan_id' => $model->layanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="layanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
