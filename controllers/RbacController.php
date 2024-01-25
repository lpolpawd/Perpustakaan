<?php

namespace app\controllers\yii;

use app\models\AdminRole;
use yii\base\InvalidRouteException;
use yii\console\Controller;
use yii\helpers\Console;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        try {
            // Membuat peran 'admin'
            $adminRole = $auth->createRole('admin');
            $auth->add($adminRole);

            // Membuat izin 'manageAdmin'
            $manageAdminPermission = $auth->createPermission('manageAdmin');
            $auth->add($manageAdminPermission);

            // Memberikan izin 'manageAdmin' kepada peran 'admin'
            $auth->addChild($adminRole, $manageAdminPermission);

            $this->stdout("RBAC initialization complete.\n", Console::FG_GREEN);
        } catch (InvalidRouteException $e) {
            $this->stderr("Error: " . $e->getMessage() . "\n", Console::FG_RED);
        }
    }

    public function init()
    {
        parent::init();

        $authManager = Yii::$app->authManager;

        $adminRole = new AdminRole(['name' => 'admin']);
        $editorRole = new AdminRole(['name' => 'editor']);
        $viewerRole = new AdminRole(['name' => 'viewer']);

        $authManager->add($adminRole);
        $authManager->add($editorRole);
        $authManager->add($viewerRole);

        // Menetapkan hierarki role
        $authManager->addChild($adminRole, $editorRole);
        $authManager->addChild($adminRole, $viewerRole);
    }

    public function actionSomeAction()
    {
        $authManager = Yii::$app->authManager;

        // Sekarang Anda dapat menggunakan $authManager untuk mengakses fungsi-fungsi RBAC
        $assignments = $authManager->getAssignments(Yii::$app->user->id);

        // ... kode lainnya ...
    }

}
