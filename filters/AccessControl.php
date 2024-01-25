<?php

namespace app\filters;

use yii;
use yii\base\Action;
use yii\base\ActionFilter;
use yii\web\User;

class AccessControl extends ActionFilter
{
    public function beforeAction($action)
    {
        /** @var User $user */
        $user = Yii::$app->user;

        if ($user->isGuest && $this->shouldBeLoggedIn($action)) {
            $user->loginRequired();
        }

        return parent::beforeAction($action);
    }

    protected function shouldBeLoggedIn($action)
    {
        // Aksi 'edit' hanya diizinkan untuk pengguna dengan peran 'admin'
    if ($action->id === 'edit') {
        return Yii::$app->user->can('admin') ? false : true;
    }

    return true; // Aksi lainnya memerlukan login

    // Misalnya, aksi 'pinjam' memerlukan login
    // if ($action->id === 'pinjam') {
    //     return Yii::$app->user->isGuest ? true : false;
    // }

    // return false; // Aksi lainnya tidak memerlukan login
    }
}
