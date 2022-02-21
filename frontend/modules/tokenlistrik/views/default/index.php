<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Library;
$this->title = 'Home';

$this->registerJsFile(
    '@web/js/pulsa-data.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
  );
?>
<div class="site-home-index">
    <div class="form-group" style="margin: 20px 20px 20px 0px">
        <?= $this->render('_form', [
            'model'        => $model,
            'modelLayanan' => $modelLayanan
        ]) ?>
    </div>

    <?php if (isset($modelProduk)) : ?>
        <div class="list-kategori row">
            <?php foreach ($modelProduk as $value): ?>
                <label class="kategori" data-id='<?= $value->code ?>' id='id-<?= $value->code ?>' style="width: 10%; margin:22px; padding:10px;">
                    <figcaption><?= $value->name ?></figcaption>
                    <figcaption><?= (new Library)->getFormatRupiah($value->price) ?></figcaption>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
