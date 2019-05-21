<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\Makanan;
use app\models\Kategori;

/* @var $this yii\web\View */

$this->title = 'My Yii CRUD';
?>
<div class="site-index">
	<h1>Tambah Makanan</h1>

    <div class="body-content">
    	<?php
    	$form = ActiveForm::begin()?>
        <div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        		<?= $form->field($food, 'nama'); ?>
        		</div>
        	</div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
       <?php $cat=Kategori::find()->all();
$listData=ArrayHelper::map($cat,'id_kategori','nama_kategori');
echo $form->field($food, 'id_kategori')->dropDownList(
        $listData,
        ['prompt'=>'Select']
        );
?>
                </div>
            </div>
        </div>

          <div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        		<?= $form->field($food, 'keterangan'); ?>
        		</div>
        	</div>
    	</div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                <?= $form->field($food, 'stok'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                <?= $form->field($food, 'harga'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <?= $form->field($food, 'img')->fileInput(); ?>
        </div>

    	<div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        			<div class="col-lg-3">
        			<?= Html::submitButton('Create Post',['class'=>'btn btn-primary']);?>
        			</div>
        			<div class="col-lg-2">
        			<a href=<?php echo Yii::$app->homeUrl; ?> class=btn btn-primary >go back</a>
        			</div>
        		</div>
        	</div>
    	</div>

	<?php ActiveForm::end() ?>
</div>
</div>