<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/17/18
 * Time: 6:23 AM
 */
namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Установка ролей и назначение
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $adminRole = $auth->getRole('administrator');
        if (is_null($adminRole)) {
            $adminRole = $auth->createRole('administrator');
            $auth->add($adminRole);
        }

        $userRole = $auth->getRole('user');
        if (is_null($userRole)) {
            $userRole = $auth->createRole('user');
            $auth->add($userRole);
        }
    }

    /**
     * Назначить роль администратора пользователю с $id
     * @param $id
     * @throws \Exception
     */
    public function actionSetAdministrator($id)
    {
        $user = User::find()->andWhere(['id' => $id])->one();
        if ($user) {
            $auth = Yii::$app->authManager;
            $adminRole = $auth->getRole('administrator');
            if ($adminRole) {
                $roles = $auth->getRolesByUser($user->id);
                $bExists = false;
                foreach($roles as $itemRole) {
                    if ('administrator' == $itemRole->name) {
                        $bExists = true;
                        break;
                    }
                }
                if (!$bExists) {
                    $auth->assign($adminRole, $user->id);
                }
            } else {
                echo 'Запустите php yii rbac/init';
            }

        } else {
            echo 'User not found';
        }
    }
}