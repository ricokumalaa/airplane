<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Signin;

class LogoutController extends SessionController
{
    public function actionIndex()
    {
         // $this->layout = 'navbar';
         $session = Yii::$app->session;
         $session->open();
         $session->remove('id');
         $session->remove('firstName');
         $session->close();
         
         $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
    }
}