<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kategori;
use common\models\Layanan;
use common\models\Provinsi;
use common\models\Kota;
use common\models\KategoriGame;
use common\components\Library;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form yii\widgets\ActiveForm */
// $this->registerJs('
//     let kota_id = '.$model->kota_id.';
// ');
$this->registerJsFile(
    '@web/js/produk/index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= 
        $form->field($model, 'code_layanan')
        ->dropDownList(
            ArrayHelper::map(Layanan::find()->where(['is_delete' => '1'])->orderBy(['nama_layanan' => SORT_ASC])->all(), 'code', 'nama_layanan'),
            ['prompt' => 'Pilih Layanan', 'id' => 'layanan_dropdown'],
        )
        ->label('Layanan'); 
    ?>

    <?= 
        $form->field($model, 'provinsi_id')
        ->dropDownList(
            ArrayHelper::map(Provinsi::find()->orderBy(['nama_provinsi' => SORT_ASC])->all(), 'provinsi_id', 'nama_provinsi'),
            ['prompt' => 'Seluruh Indonesia', 'id' => 'provinsi_dropdown'],
        )
        ->label('Provinsi'); 
    ?>
    <?php if ($model->kota_id) : ?>
        <?= 
            $form->field($model, 'kota_id')
            ->dropDownList(
                ArrayHelper::map(Kota::find()->where(['provinsi_id' => $model->provinsi_id])->orderBy(['nama_kota' => SORT_ASC])->all(), 'kota_id', 'nama_kota'),
                ['prompt' => 'Seluruh Indonesia', 'id' => 'kota_dropdown'],
            )
            ->label('Kota'); 
        ?>
    <?php endif ?>
    <?php if (!$model->kota_id) : ?>
        <div class="form-group field-kota_dropdown has-success"></div>
    <?php endif ?>

    <?= 
        $form->field($model, 'jenis')
        ->dropDownList(
            (new Library)->getJenis(),
            ['prompt' => 'Pilih Jenis Produk', 'id' => 'jenis_dropdown'],
        )
        ->label('Jenis Produk'); 
    ?>

    <?= 
        $form->field($model, 'sub_produk')
        ->dropDownList(
            (new Library)->getSubProduk(),
            ['prompt' => 'Pilih Provider', 'id' => 'sub_produk_dropdown'],
        )
        ->label('Provider'); 
    ?>

    <?= $form->field($model, 'is_emoney')->dropDownList(
        (new Library)->getEmoney(),
        ['prompt' => 'Pilih E-Money Top Up', 'id' => 'emoney_admin_dropdown'],
    )->label('Pilih') ?>

    <?= $form->field($model, 'is_emoney_status')->dropDownList(
        (new Library)->getStatusAkun(),
        ['prompt' => 'Pilih Status Akun Sebagai', 'id' => 'statusakun_dropdown'],
    )->label('Status Akun') ?>


    <?= $form->field($model, 'kategori_game')->dropDownList(
        ArrayHelper::map(KategoriGame::find()->where(['is_delete' => '1'])->orderBy(['kategori_game' => SORT_ASC])->all(), 'code', 'kategori_game'),
        ['prompt' => 'Pilih Kategori Game', 'id' => 'game_dropdown'],
    )->label('Kategori Games') ?>

    <?= $form->field($model, 'kode_produk')->textInput(['placeholder' => 'Kode Produk']) ?>
    
    <?= $form->field($model, 'nama_produk')->textInput(['placeholder' => 'Nama Produk']) ?>
    
    <?= $form->field($model, 'harga_markdown')->textInput(['placeholder' => 'Penurunan Harga']) ?>

    <?= $form->field($model, 'harga_markup')->textInput(['placeholder' => 'Kenaikan Harga']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
