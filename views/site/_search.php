<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MakananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="makanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_food') ?>

    <?php// echo $form->field($model, 'id_kategori') ?>

    <?php// echo $form->field($model, 'nama') ?>

    <?php// echo $form->field($model, 'keterangan') ?>

    <?php// echo $form->field($model, 'stok') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <?php // echo $form->field($model, 'img') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>