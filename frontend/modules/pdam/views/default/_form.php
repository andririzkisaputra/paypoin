<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\Provinsi;
use common\models\Kota;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'trxtype')->textInput(['type' => 'hidden', 'id' => 'trxtype', 'value' => $modelLayanan])->label(false) ?>

        <?= 
            $form->field($model, 'code')->dropDownList(
                ArrayHelper::map(
                    Product::find()->where([
                        'type'     => $modelLayanan,
                        'category' => 'CEK PDAM'
                    ])->orderBy(['name' => SORT_ASC])->all(), 'code', 'name'
                ),
                ['id' => 'provinsi_dropdown'],
            )
            ->label('Wilayah'); 
        ?>
        
        <?= $form->field($model, 'data')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => '123456789',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Nomor Pelanggan') ?>

        <div class="form-group">
            <?= Html::submitButton('Cek Tagihan', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
