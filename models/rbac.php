<?php
	namespace app\rbac;

	use Yii;
	use yii\rbac\Rule;

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