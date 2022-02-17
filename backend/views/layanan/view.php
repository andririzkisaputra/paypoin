<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Layanan;
use yii\bootstrap4\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\Layanan */

$this->title = $model->nama_layanan;
$this->params['breadcrumbs'][] = ['label' => 'Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Ubah', ['update', 'layanan_id' => $model->layanan_id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Upload Gambar', ['file-upload/create', 'session_upload_id' => $model->session_upload_id, 'pathName' => 'layanan'], ['class' => 'btn btn-info']) ?>
                <?= 
                    Html::a('Hapus Layanan', ['delete', 'layanan_id' => $model->layanan_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to change this status item?',
                            'method' => 'post',
                        ],
                    ]) 
                ?>
            </p>
            <div class="row">
                <div class="col-sm-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'layanan_id',
                            'code',
                            'nama_layanan',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h4>Gambar</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                $items = [];
                                foreach ($model->gambar as $key => $value) {
                                    $items[] = [
                                        'label' => $key+1,
                                        'content' => $this->render('_gambar', ['model' => $value])
                                    ];
                                }
                                echo Tabs::widget(['items' => $items]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
