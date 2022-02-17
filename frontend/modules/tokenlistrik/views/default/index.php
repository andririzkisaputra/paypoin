<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Home';

$this->registerJsFile(
    '@web/js/pulsa-data.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
  );
?>
<style>
    .list-kategori {
        /* display: grid; */
        /* column-count: 5; */
        border: 1px solid;
        padding: 35px 0px 35px 0px; 
        border-radius: 10px;
    }
    .list-kategori .kategori {
        border: 1px solid; 
        padding: 10px;
        margin: 0px 30px 0px 30px;
        border-radius : 5px;
        justify-content: inherit;
    }
    .list-harga {
        border: 1px solid;
        margin: 20px 0px 0px 0px;
        padding: 35px 35px 35px 35px; 
        border-radius: 10px;
        /* text-align: justify; */
        cursor: pointer;
    }
    .border-active {
        border-color: #0094c9
    }
    .border-deactive {
        border-color: #000000
    }
    label:hover {
        cursor: pointer;
    }
    img{
		position: relative;
		z-index: 1;
		top: 0px;
	}
	figcaption {
        text-align-last: center;
	}
    .click_produk {
        border: 1px solid; 
        border-radius: 5px;
    }

    .active, .click_produk:hover {
        border-color: #0094c9
    }
</style>
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
                <label class="click_produk" data-id='<?= $value['kode_produk'] ?>' id='id-<?= $value['kode_produk'] ?>' style="width: 10%; margin:22px; padding:10px;">
                    <figcaption><?= $value['nama_produk'] ?></figcaption>
                    <figcaption><?= $value['total_harga_f'] ?></figcaption>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
