<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $index integer */
/** @var $model \common\models\Kategori */

?>

<?php if ($model) { ?>
    <?= Html::img(Url::toRoute(['image', 'session_upload_id' => $model->session_upload_id]), ['class' => 'img-responsive', 'style' => 'width: 100%']); ?>
<?php } ?>



