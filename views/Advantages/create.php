<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\landing\Advantages */

$this->title = Yii::t('modules/notifications', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/notifications', 'Advantages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advantages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
