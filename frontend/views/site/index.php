<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Home';
?>
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
