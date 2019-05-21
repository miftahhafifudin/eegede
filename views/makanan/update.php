<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Makanan */

$this->title = 'Update Makanan: ' . $model->id_food;
$this->params['breadcrumbs'][] = ['label' => 'Makanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_food, 'url' => ['view', 'id' => $model->id_food]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="makanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
