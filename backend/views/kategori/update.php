<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */

$this->title = 'Update Kategori: ' . $model->nama_kategori;
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_kategori, 'url' => ['view', 'kategori_id' => $model->kategori_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
