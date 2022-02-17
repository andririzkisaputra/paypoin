<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FileUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-upload-form">

    <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'img')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>