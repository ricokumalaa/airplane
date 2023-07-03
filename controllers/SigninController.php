<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Signin;

class SigninController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId != NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("user/"));
        }

        $this->layout = 'airplanenav';

        // die(var_dump($this->sessionId));

        return $this->render('signin');
    }

    public function actionSigninUser()
    {
        $signIn = new Signin();

        $email = Yii::$app->request->getBodyParam('email');
        $password = Yii::$app->request->getBodyParam('password');

        $signIn->email = $email;
        $signIn->password = $password;
        $signIn->scenario = 'check-login';

        if($signIn->validate())
        {
            $result = $signIn->checkUser();
            // die(var_dump($result));

            if(count($result) > 0)
            {
                $res = $result[0];
                $hashedPass = $res["PASSWORD"];
                $verifPass = password_verify($password, $hashedPass);
                // die(var_dump($verifPass));

                if($verifPass)
                {
                    // die(var_dump($verifPass));
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('id', $res["ID"]);
                    $session->set('firstName', $res["FIRST_NAME"]);
                    $session->close();
                    return $this->redirect(['user/']);
                }
                else
                {
                    return json_encode([
                        'errNum' => 1,
                        'errStr' => 'Incorrect password!'
                    ]);
                }
            }
            else
            {
                return json_encode([
                    'errNum' => 1,
                    'errStr' => 'Incorrect email!'
                ]);
            }

        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $signIn->errors
            ]);
        }

        return $this->render('login');
    }
}