<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
use yii\widgets\ArrayHelper;
use yii\web\Controller;
use app\models\BackendUser;

$this->title = 'Register';
?>
<div class="site-index">
	<h1>REGISTER COY</h1>

	<div class="body-content">
		<?php
		$form = ActiveForm::begin()?>

		<div class="row">
			<div class="form-group">
				<div class="col-lg-6">
				<?= $form->field($model,'username');?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-lg-6">
				<?= $form->field($model,'password')->passwordInput();?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-lg-6">
				<?= $form->field($model,'nama_asli');?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-lg-6">
				<?= $form->field($model,'email');?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-lg-6">
				<?= $form->field($model,'token');?>
				</div>
			</div>
		</div>

		<div class="row">
        	<div class="form-group">
        		<div class="col-lg-6">
        			<div class="col-lg-3">
        			<?= Html::submitButton('REGISTER',['class'=>'btn btn-primary']);?>
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