<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Provinsi;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
    '@web/js/produk/index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="kota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= 
        $form->field($model, 'provinsi_id')
        ->dropDownList(ArrayHelper::map(Provinsi::find()->all(), 'provinsi_id', 'nama_provinsi'))
        ->label('Wilayah'); 
    ?>

    <?= $form->field($model, 'nama_kota')->textInput(['placeholder' => 'Nama Kota']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
