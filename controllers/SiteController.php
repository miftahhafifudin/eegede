<?php

namespace app\controllers;

use Yii;
use yii\rbac\Rule;
use yii\base\Behavior;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Makanan;
use app\models\MakananSearch;
use app\models\Kategori;
use app\models\BackendUser;
use yii\web\uploadedFile;
use yii\web\unlink;
use yii\data\Sort;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        // var_dump(Yii::$app->user->getIdentity()->getId_group());exit;
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'=> ['create','update','delete'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (Yii::$app->user->getIdentity()->getId_group() =='1');
                        }
                    ],
                    [ 'actions'=> ['login'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return true;
                        }
                    ],
                    [ 'actions'=> ['index','logout'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (!Yii::$app->user->isGuest);
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' =>['post','get'],
                    'update' =>['post'],
                    'delete' =>['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site%2Flogin');
        }
        $sort = new Sort([
        'attributes' => [
            'nama' => [
                'asc' => ['nama' => SORT_ASC],
                'desc' => ['nama' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Name',
            ],
        ],
    ]);

 $foods = Makanan::find()
            
                ->orderBy($sort->orders)
                ->all();
       
    $searchModel = new MakananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'foods'=>$foods,
            'sort'=>$sort,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

       

    }

    public function actionCreate(){
        $food = new Makanan();
        if($food->load(Yii::$app->request->post())){
            $image=Uploadedfile::getInstance($food,'img');
            $food->img=$image->name;
            if($food->validate()){
            $food->save();
            $image->saveAs(Yii::$app->basePath . '/web/upload/' . $image->name);  
            }else{
            }
            return $this->redirect(['index']);
        }

        return $this->render('create',['food'=>$food]);
    }

    public function actionUpdate($id){
        $food = Makanan::findOne($id);
        if($food->load(Yii::$app->request->post())){
        $image=UploadedFile::getInstance($food,'img');
        $food->img=$image->name;
        $food->save();
        $image->saveAs(Yii::$app->basePath . '/web/upload' . $image->name);
         return $this->redirect(['index','id_food'=> $food->id_food]);
     }
        return $this->render('update',['food'=> $food]);
    }

    public function actionKategori(){
      $food = new Kategori();
        $formData = (Yii::$app->request->post());
        if($food->load($formData)){
            if($food->save()){
                Yii::$app->getSession()->setFlash('message','Post Published Succesfully');
                return $this->redirect(['index']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed toPost');
            }
        } 
        return $this->render('category',['food'=>$food]);
    }

     public function actionView($id){
        $food = Makanan::findOne($id);
        return $this->render('view',['food'=> $food]);
    }   


     public function actionDelete($id){
          $food = Makanan::findOne($id);
          
        if(!is_null($food)){
            $message= 'Deleted Succesfully';
            try{  unlink(Yii::$app->basePath. '/web/upload/' . $food->img);
                $food->delete();

            }catch( yii\base\ErrorException $e){
                $message = 'ERROR BOSQ '.$e->getMessage();
            }
          
            Yii::$app->getSession()->setFlash('message',$message);
            
        }
        return $this->redirect(['index']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('?r=site%2Findex');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->redirect('?r=site%2Findex'); 
        }
    
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function getToken($token){
        $model = BackendUser::model()->findByAttributes(array('token'=>$token));
    }

   public function activeVerToken($token){
    $model=$this->getToken($token);
    if(isset($_POST['ganti'])){
        if($model->token==$_POST['ganti']['tokenhid']){
            $model->password=($_POST['ganti']['password']);
            $model->token="null";
            $model->save();
            Yii::app()->user->setFlash('ganti','<b>Passwod Udah Keganti. Login Tod</b>');
            $this->redirect('?r=site%2Flogin');
            $this->refresh();
        }
    }
    $this->render('verifikasi',array('model'=>$model));
   }

   public function actionForgot(){
    
    $getModel=BackendUser::model()->findByAttributes(array('email'=>$getEmail));

    if(isset($_POST['lupa'])){
        $getEmail=$_POST['forgot']['Email'];
        $getToken=rand(0,99999);
        $getTime=date("H:i:s");
        $getModel->token($getToken.$getTime);
        $namaPengirim="Yang punya laptop";
        $emailadmin="miftahhafifudin@gmail.com";
        $subjek="reset password";
        $setpesan="you have successfully reset your password<br/>
                    <a href='http://eegede.local/index.php?r=site%2Flogin=".$getModel->token."'>Click Here to Reset Password</a>";


        if($getModel->validate()){
            $name='=?UTF-8?B?'.base64_encode($namaPengirim).'?=';
                $subject='=?UTF-8?B?'.base64_encode($subjek).'?=';
                $headers="From: $name <{$emailadmin}>\r\n".
                    "Reply-To: {$emailadmin}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/html; charset=UTF-8";
                $getModel->save();
                                Yii::app()->user->setFlash('forgot','link to reset your password has been sent to your email');
                mail($getEmail,$subject,$setpesan,$headers);
                $this->refresh();
        }
    }
    $this->render('forgot');
   }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
class UserGroupRule extends Rule{
    public $name ='usergroup';

    public function execute($user, $item, $params){
         if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->group;
            if ($item->name === 'admin') {
                return $group == 1;
            } elseif ($item->name === 'user') {
                return $group == 1 || $group == 2;
            }
        }
        return false;
    }
}