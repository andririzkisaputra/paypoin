<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $index integer */
/** @var $model \common\models\Kategori */

?>

<?php if ($model) { ?>
    <?= Html::img(Url::toRoute(['image', 'img' => $model->img]), ['class' => 'img-responsive', 'style' => 'width: 50%']); ?>
<?php } ?>



