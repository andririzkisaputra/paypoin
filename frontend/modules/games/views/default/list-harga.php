<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Library;
$this->title = 'Home';

$this->registerJsFile(
    '@web/js/game-list.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="site-home-index">
    <div class="form-group" style="margin: 20px 20px 20px 0px">
        <?= $this->render('_form', [
            'model'        => $model,
            'modelLayanan' => 'games'
        ]) ?>
        <div class="list-kategori">
            <?php foreach ($modelProduk as $key => $value) :?>
                <div class="kategori" data-id="<?= $value->kode_produk ?>">
                    <div class="">
                        <?= Html::img(Url::toRoute(['image', 'session_upload_id' => $games->session_upload_id]), ['class' => 'img-responsive', 'style' => 'width: 100px; height: 100px; margin: 20px;']); ?>
                    </div>
                    <div class="" style="background-color: #ffc105; color: #ffffff; text-align: center; margin-top: revert;">
                        <p><b><?= $value->nama_produk; ?></b></p>
                        <p><b><?= (new Library)->getFormatRupiah($value->harga_produk); ?></b></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
