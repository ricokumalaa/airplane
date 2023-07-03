<?php

namespace app\controllers;

use Yii;
use app\extensions\SessionController;
// use yii\web\Controller;

class LangController extends SessionController
{

    public function actionIndex()
    {        

        // $this->layout = 'navbar';
        $languageSelect = Yii::$app->request->getBodyParam('language');
        // die(var_dump("halloo"));
        $session = Yii::$app->session;
        $session->open();
        $session->set('language', $languageSelect);
        $session->close();

        // die(var_dump(Yii::$app->session['language']));
        
        return true;
    }

}