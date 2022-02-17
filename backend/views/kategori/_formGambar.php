<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FileUpload */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Gambar';
?>

<div class="file-upload-form">

    <?php $form = ActiveForm::begin(); ?>
        
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $form->field($model, 'img')->fileInput()->label('Gambar Kategori') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
