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

        <?= $form->field($model, 'trxtype')->textInput(['type' => 'hidden', 'id' => 'code_layanan', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'code')->textInput(['type' => 'hidden', 'id' => 'kode_produk'])->label(false) ?>

        <?= $form->field($model, 'data')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => '112233445566',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('No. Meter/ID Pel') ?>

        <div class="form-group">
            <?= Html::submitButton('Beli', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
