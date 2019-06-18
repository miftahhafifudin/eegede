<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\rbac\Rule;

/**
 * This is the model class for table "user".
 *
 * @property int $ID
 * @property string $username
 * @property string $password
 * @property string $nama_asli
 * @property string $email
 * @property string $token
 */
class backedUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    private $ID;
    private $username;
    private $password;
    private $nama_asli;
    private $email;
    private $id_grup;
    private $token;
    private $auth_key;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_asli', 'email', 'token','password'], 'required'],
            [['username'], 'string'],
            [['nama_asli', 'email', 'token'], 'string', 'max' => 100],
        ];
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null){
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function getId(){
        return $this->getAttribute('ID');
    }

    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validateAuthKey($authKey){
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password){
          return md5($password)===$this->getAttribute('password');

    }

    public function getId_group(){
        return $this->getAttribute('id_grup');
    }
    // public function save($runValidation = true, $attributeNames = NULL){
        
    //     if ($this->getIsNewRecord()) {
    //     return $this->insert($runValidation, $attributeNames);
    // } else {
    //     return $this->update($runValidation, $attributeNames) !== false;
    // }
    // }


    public function beforeSave($insert)
{
    if (!parent::beforeSave($insert)) {
        return false;
    }
    $this->setAttribute('password',md5($this->password));
    // ...custom code here...
    return true;
}
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'nama_asli' => 'Nama Asli',
            'email' => 'Email',
            'token' => 'Token',
        ];
    }
}
