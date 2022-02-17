<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Home';
?>
<style>
    .list-kategori {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        cursor: hand;
        /* border: 1px solid; */
        /* padding: 35px 0px 35px 0px;  */
        border-radius: 10px;
    }
    .list-kategori .kategori {
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: #000;
        /* border: 1px solid;  */
        /* padding: 10px; */
        background-color: #dbdbdb;
        margin: 10px 30px 10px 30px;
        border-radius : 5px;
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
    <div class="row">
        <?php foreach ($modelKategori as $value): ?>
            <div class="list-kategori">
                <a href="<?= strtolower(preg_replace("/ /","-", $value->real)) ?>" class="kategori">
                    <div class="">
                        <?= Html::img(Url::toRoute(['image', 'img' => $value->img]), ['class' => 'img-responsive', 'style' => 'width: 100px; height: 100px; margin: 20px;']); ?>
                    </div>
                    <div class="" style="background-color: #ffc105; color: #ffffff; text-align: center; margin-top: revert;">
                        <b><?= $value->real; ?></b>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <br/>

</div>
