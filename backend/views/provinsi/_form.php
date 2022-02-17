<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kategori;
use common\models\Layanan;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
    '@web/js/produk/index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'nama_provinsi')->textInput(['placeholder' => 'Nama Provinsi']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
