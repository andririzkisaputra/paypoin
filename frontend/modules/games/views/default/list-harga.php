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
                <label class="kategori" data-id="<?= $value->code ?>" style="width: 150px;">
                    <div class="">
                        <?= Html::img(Url::toRoute(['image', 'img' => $value->img]), ['class' => 'img-responsive', 'style' => 'width: 50%; min-width: -webkit-fill-available']); ?>
                    </div>
                    <div class="bottom-text-list">
                        <p><b><?= $value->name; ?></b></p>
                        <p><b><?= (new Library)->getFormatRupiah($value->price); ?></b></p>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>
