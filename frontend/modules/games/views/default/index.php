<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Home';

?>
<div class="site-home-index">
    <div class="form-group" style="margin: 20px 20px 20px 0px">
        <div class="list-kategori">
            <?php foreach ($modelGame as $key => $value) :?>
                <a href="games/default/list-harga?game=<?= $value->kategori_game ?>" class="kategori">
                    <div class="">
                        <?= Html::img(Url::toRoute(['image', 'session_upload_id' => $value->session_upload_id]), ['class' => 'img-responsive', 'style' => 'width: 100px; height: 100px; margin: 20px;']); ?>
                    </div>
                    <div class="bottom-text-list">
                        <b><?= $value->kategori_game; ?></b>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
