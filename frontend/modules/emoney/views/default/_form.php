<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Produk;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'code_layanan')->textInput(['type' => 'hidden', 'id' => 'code_layanan', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'kode_produk')->textInput(['type' => 'hidden', 'id' => 'kode_produk'])->label(false) ?>

        <?= $form->field($model, 'is_emoney')->dropDownList(
            (new Library)->getEmoney(),
            ['prompt' => 'Pilih E-Money Top Up', 'id' => 'emoney_dropdown'],
        )->label('Pilih') ?>

        <?= $form->field($model, 'is_emoney_status')->dropDownList(
            (new Library)->getStatusAkun(),
            ['id' => 'statusakun_dropdown'],
        )->label('Status Akun') ?>

        <?= $form->field($model, 'dest')->textInput([
            'class'       => 'form-control',
            // 'onkeyup'     => 'cekNotelp()',
            'type'        => 'tel',
            'placeholder' => 'No 08xxx',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Nomor Telpon') ?>

        <div class="form-group">
            <?= Html::submitButton('Beli', ['class' => 'btn btn-primary btn-sm tombol']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
