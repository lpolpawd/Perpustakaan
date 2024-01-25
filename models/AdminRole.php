<?php

namespace app\models;

use yii\rbac\Role;

class AdminRole extends \yii\base\BaseObject 
{
    public $name = 'admin';

    public function getName()
    {
        return $this->name;
    }

    public function getPermissions()
    {
        // Implementasikan logika untuk mengembalikan izin yang terkait dengan role admin
        // Misalnya, Anda dapat mengambil izin dari model Admin
        $adminModel = Admin::findOne(['role' => $this->name]);
        
        // Pastikan untuk mengganti 'izin1', 'izin2', dll. dengan izin sesuai model Anda
        return ['izin1', 'izin2'];
    }
}
