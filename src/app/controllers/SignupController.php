<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function IndexAction()
    {
        $myescaper = new \App\Components\myescaper();
        $this->view->date = $myescaper->getCurrentDate();
    }

    public function registerAction()
    {
        $user = new Users();
        $data = $this->request->getPost();
        // print_r(json_encode($data));
        // die();
        $myescaper = new \App\Components\myescaper();
        $santitizedata = $myescaper->sanitize($data);
        $user->assign(
            $santitizedata,
            [

                'name',
                'email',
            ]
        );
        // print_r(json_encode($user));
        // die("hii");

        $success = $user->save();

        $this->view->success = $success;

        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
    }

    public function testAction()
    {
        echo "hello";
    }
}
