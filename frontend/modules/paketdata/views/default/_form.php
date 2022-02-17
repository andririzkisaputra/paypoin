<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Produk;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'type')->textInput(['type' => 'hidden', 'id' => 'type', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'code')->textInput(['type' => 'hidden', 'id' => 'code'])->label(false) ?>

        <?= $form->field($model, 'dest')->textInput([
            'class'       => 'form-control',
            'onkeyup'     => 'list_harga()',
            'type'        => 'tel',
            'placeholder' => 'No 08xxx',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Nomor Telpon') ?>

        <p id="error_para" class="text-danger">Periksa kembali nomor anda</p>

        <div class="form-group">
            <?= Html::submitButton('Beli', ['class' => 'btn btn-primary btn-sm tombol']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
