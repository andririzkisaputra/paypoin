<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kategori;

/* @var $this yii\web\View */
/* @var $model common\models\Layanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>
        
    <?= 
        $form->field($model, 'kategori_id')
        ->dropDownList(ArrayHelper::map(Kategori::find()->where(['is_delete' => '1'])->all(), 'kategori_id', 'nama_kategori'))
        ->label('Kategori'); 
    ?>
    
    <?= $form->field($model, 'nama_layanan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
