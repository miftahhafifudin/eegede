<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii CRUD';
?>
<div class="site-index">
	<h1>Tambah Kategori</h1>

    <div class="body-content">
    	<?php
    	$form = ActiveForm::begin()?>
        <div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        		<?= $form->field($food, 'nama_kategori'); ?>
        		</div>
        	</div>
        </div>

        

    	<div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        			<div class="col-lg-3">
        			<?= Html::submitButton('Tambah',['class'=>'btn btn-primary']);?>
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