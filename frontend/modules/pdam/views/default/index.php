<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Home';
?>
<div class="site-home-index">
    <div class="form-group" style="margin: 20px 20px 20px 0px">
        <?= $this->render('_form', [
            'model'        => $model,
            'modelLayanan' => $modelLayanan,
            'modelWilayah' => $modelWilayah,
        ]) ?>
    </div>
    <div id="my_harga"></div>
</div>
