<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Makanan extends ActiveRecord
	{
		private $nama;
		private $keterangan;
		private $stok;
		private $harga;
		private $img;
		private $id_kategori;
		 public static function getDb()
	    {
	        return \Yii::$app->db;  
	    }
		public static function tableName(){
			return 'makanan';
		}
		public function rules(){
			return[
				[['nama','id_kategori','keterangan','stok','harga','img'],'required'],
				[['img'],'file','extensions'=>'jpg,jpeg,png'],
				[['stok','harga'],'integer'],
			
			];
		}
	  public function save($runValidation = true, $attribute = null){
        if($this->getIsNewRecord()){
            return $this->insert($runValidation,$attribute);
        }else
        {
            return $this->update($runValidation,$attribute) !== false;
        }
    }

	// public function afterDelete() {

 //        parent::afterDelete();

 //        $rootPath=Yii::app()->getBasePath().'/web/upload/';

 //        unlink($rootPath.'/upload/'.$this->image);

 //    }
public function getKategori(){
	return $this->hasOne(Kategori::className(),['id'=>'id_kategori']);
}



	}
?>