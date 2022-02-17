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
    .click_produk {
        border: 1px solid; 
        border-radius: 5px;
    }
    .border-active {
        border-color: #0094c9
    }
    .border-deactive {
        border-color: #000000
    }
    .click_produk:hover {
        border-color: #0094c9
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
</style>
<div class="site-home-index">
    <div class="form-group" style="margin: 20px 20px 20px 0px">
        <?= $this->render('_form', [
            'model'        => $model,
            'modelLayanan' => $modelLayanan
        ]) ?>
    </div>
    <div id="my_harga"></div>
</div>
