<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 3:52 PM
 */

namespace console\controllers;

use yii\console\Controller;
use common\models\User;

class MiscController extends Controller
{
    /**
     * Создание роли админа, если её ещё нет
     * @return int
     * @throws \Exception
     */
    public function actionCreateAdmin()
    {
        $ret = 0;
        $auth = \Yii::$app->authManager;
        $admins = $auth->getUserIdsByRole('administrator');
        if (!count($admins)) {
            $User = new User();
            $User->setPassword('111111');
            $User->generateAuthKey();
            $userName = 'admin@eno.test';
            $User->username = $userName;
            $User->email = $userName;
            if (!$User->save()) {
                $this->stdout("user create failed [".\yii\helpers\VarDumper::dumpAsString($User->getErrors())."]");
                $ret = 1;
            } else {
                $auth->assign($auth->getRole('administrator'), $User->id);
            }
        }
        return $ret;
    }
}