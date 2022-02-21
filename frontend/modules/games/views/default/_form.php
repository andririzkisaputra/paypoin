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

        <?= $form->field($model, 'trxtype')->textInput(['type' => 'hidden', 'id' => 'trxtype', 'value' => $modelLayanan])->label(false) ?>

        <?= $form->field($model, 'code')->textInput([
            'type'  => 'hidden', 
            'id'    => 'kode_produk',
        ])->label(false) ?>

        <?= $form->field($model, 'data')->textInput([
            'class'       => 'form-control',
            'type'        => 'text',
            'placeholder' => 'Player ID',
            'autofocus'   => true,
            'id'          => 'dest'
        ])->label('Player ID') ?>

        <div class="form-group">
            <?= Html::submitButton('Beli', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
