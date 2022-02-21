<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'trxtype')->textInput(['type' => 'hidden', 'id' => 'code_layanan', 'value' => $modelLayanan])->label(false) ?>
            
        <?= $form->field($model, 'code')->textInput([
            'type' => 'hidden', 
            'id' => 'kode_produk',
            'value' => Product::find()->where([
                'type'     => $modelLayanan,
                'category' => 'CEK TELKOM'
            ])->orderBy(['name' => SORT_ASC])->one()->code
        ])->label(false) ?>
        
        <?= $form->field($model, 'data')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => '112233445566',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Nomor Pelanggan') ?>

        <div class="form-group">
            <?= Html::submitButton('Cek Tagihan', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
