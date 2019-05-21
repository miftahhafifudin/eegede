<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Tampilan Makanan';
?>
<div class=
"site-index">
	<h1>Detail</h1>

    <div class="body-content">
            <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <h4>Nama</h4>
            <?php echo $food->nama; ?>
           
          </li>
          <h4>Keterangan</h4>
          <li class="list-group-item d-flex justify-content-between align-items-center">
           <?php echo $food->keterangan; ?> 
            
          </li><h4>Stok</h4>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $food->stok; ?>
            
          </li><h4>Harga</h4>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $food->harga; ?>
            
          </li><h4>Gambar</h4>
          <li class="list-group-item d-flex justify-content-between align-items-center"> 
            <?php $img = Url::to('@web/upload/').$food->img;                 
                  $image = '<img src="'.$img.'" width="600" />';  
                  echo $image;
            ?>

        </li>
        </ul>
        <div class="row">
            <a href=<?php echo Yii::$app->homeUrl; ?> class=btn btn-primary >go back</a>
        </div>
</div>
</div>