<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'trxtype')->textInput(['type' => 'hidden', 'id' => 'trxtype', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'code')->textInput(['type' => 'hidden', 'id' => 'kode_produk'])->label(false) ?>

        <?= $form->field($model, 'brand')->dropDownList(
            ArrayHelper::map(
                Product::find()->where([
                    'type'     => 'e-money'
                ])->groupBy('brand')->orderBy(['brand' => SORT_ASC])->all(), 'brand', 'brand'
            ),
            ['prompt' => 'Pilih E-Money Top Up', 'id' => 'brand'],
        )->label('Pilih') ?>

        <div class="form-group field-category" id="category"></div>
        
        <?= $form->field($model, 'data')->textInput([
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
