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
            
        <?= $form->field($model, 'code_layanan')->textInput(['type' => 'hidden', 'id' => 'code_layanan', 'value' => $modelLayanan])->label(false) ?>
        
        <?= 
            $form->field($model, 'code')->dropDownList(
            ArrayHelper::map(
                Product::find()->where([
                    'type'     => $modelLayanan,
                    'category' => 'CEK ANGSURAN'
                ])->orderBy(['name' => SORT_ASC])->all(), 'code', 'name')
            )->label('Penyedia Angsuran'); 
        ?>

        <?= $form->field($model, 'data')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => 'Nomor Kontrak',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Nomor Kontrak') ?>
        
        <div class="form-group">
            <?= Html::submitButton('Cek Tagihan', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
