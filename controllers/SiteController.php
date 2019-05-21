<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Makanan;
use app\models\MakananSearch;
use app\models\Kategori;
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
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
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
