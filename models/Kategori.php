<?php

namespace app\models;
use yii\db\activeRecord;

class Kategori extends activeRecord{
	private $id_kategori;
	private $nama_kategori;


public static function getDb()
	    {
	        return \Yii::$app->db;  
	    }
public static function tableName(){
			return 'kategori';
		}
public function rules(){
	return[
			[['nama_kategori'],'required'],
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

public function getMakanan(){
	return $this->hasOne(Makanan::className(),['id_kategori'=>'id']);
}

}

?>