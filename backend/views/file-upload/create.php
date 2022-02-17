<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FileUpload */

$this->title = 'Upload Gambar';
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-upload-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
