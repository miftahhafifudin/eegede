<?php
	namespace app\controllers;

	use yii;
	use yii\web\Controller;
	use app\models\LoginForm;
	use app\models\BackedUser;

	class UserController extends Controller{



		public function actionRegister(){
			$model = new BackedUser();
			if($model->load(Yii::$app->request->post())){
				if($model->save()){
					Yii::$app->getSession()->setFlash('message','AKUN SUDAH DI BUAT :D');
					return $this->redirect(['site/login']);
				}
				else{
					Yii::$app->getSession()->setFlash('message','GAGAL BUAT AKUN AMKJ :(');
				}
			}
		return $this->render('register',['model'=>$model]);
		}

	}
