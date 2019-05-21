<?php
use yii\helpers\html;
use app\models\Kategori;
/* @var $this yii\web\View */

$this->title = 'TABLE FOOD';
?>

<div class="site-index">
<?php if (yii::$app->session->hasFlash('message')): ?>
            <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= yii::$app->session->getFlash('message');?>
        </div>
<?php endif; ?>
    <div class="header" align="center">
        <h1><font color="red">Yii2 FOOOOOOOOD</font></h1>
    </div>

     <div class="row">
        <span style="margin-top:60px"><?= Html::a('Tambah Makanan',['/site/create'],['class' => 'btn btn-primary']) ?></span>
        <span style="margin-top:60px"><?= Html::a('KATEGORI',['/kategori/index'],['class' => 'btn btn-primary']) ?></span>
    </div>
 

    <div class="body-content">
        <div class="row">
        <table class="table table-hover" border ="1">
  <thead>
    <tr align="">
      <th scope="col">ID</th>
      <th scope="col">NAMA</th>
      <!-- <th scope="col">KATEGORI</th> -->
      <th scope="col">KETERANGAN</th>
      <th scope="col">STOK</th>
      <th scope="col">HARGA</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <?= $sort->link('nama'); ?>
    <?php if(count($foods ) > 0): ?>
    <?php foreach($foods as $food):?>
    <tr class="table-active">
      <th scope="row"><?= $food->id_food;?></th>
      <td><?= $food->nama;?></td>
      <td><?= $food->keterangan;?></td>
      <td><?= $food->stok;?></td>
      <td><?= $food->harga;?></td>
 
      <td>
        <span><?=Html::a('view',['view','id'=>$food->id_food],['class'=>'label label-primary'])?></span>
        <span><?=Html::a('update',['update','id'=>$food->id_food],['class'=>'label label-default'])?></span>
        <span><?=Html::a('delete',['delete','id'=>$food->id_food],['class'=>'label label-danger'])?></span>
      </td>
    </tr>
<?php endforeach ; ?>
    <?php else: ?>
        <tr>
            <td>NO record</td>
        </tr>
    <?php endif; ?> 
  </tbody>
</table>
    </div>
</div>

