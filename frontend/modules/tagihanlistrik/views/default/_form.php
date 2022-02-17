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

        <?= $form->field($model, 'code_layanan')->textInput(['type' => 'hidden', 'id' => 'code_layanan', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'kode_produk')->textInput([
            'type'  => 'hidden', 
            'id'    => 'kode_produk',
            'value' => Produk::find()->where([
                'is_delete' => '1',
                'code_layanan' => $modelLayanan
            ])->one()->kode_produk
        ])->label(false) ?>

        <?= $form->field($model, 'dest')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => '112233445566',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('No. Meter/ID Pel') ?>

        <div class="form-group">
            <?= Html::submitButton('Cek Tagihan', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
