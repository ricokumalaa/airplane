<?php

namespace app\extensions;

use Yii;
use yii\web\Controller;

class SessionController extends Controller
{   
    public $sessionId;
    public $sessionFirstName;
    public $sessionLang;
    public $getControllerName;

    public function init()
    {
        // die("init");
        parent::init();

        $this->sessionId = Yii::$app->session['id'];
        $this->sessionFirstName = Yii::$app->session['firstName'];
        Yii::$app->language  = Yii::$app->session['language'];
        $this->sessionLang = Yii::$app->language;
        // die(var_dump($this->sessionId));
    }

    // public function beforeAction($event)
    // {
    //     // die(var_dump(Yii::$app->controller->id));
    //     $this->getControllerName = Yii::$app->controller->id;
    //     // die(var_dump($session_name));
    //     return parent::beforeAction($event);
    // }

    public function actionUppercaseString($text)
    {
        return strtoupper($text);
    }
}