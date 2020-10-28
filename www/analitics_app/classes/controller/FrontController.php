<?php


class FrontController
{

    public function login($email, $password) {
        $User = new User();
        $user = $User->login($email,$password);
        $session = new Session();
        $session->login($user[0]);

        if ($_SESSION['user_role'] == 'user'){
            $User->redirect('index.php');
        }else{
            $User->redirect('admin');
        }
    }

    public function allActions () {
        $action = new Action();
        return $action->find_all();
    }

    public function setActionData($user_id, $action_id ){
        $user_act = new Model();
        $exist_user_act = $user_act->find_by_query("SELECT * FROM `users_action` WHERE user_id = '{$user_id}'
                                                      AND  action_id = '{$action_id}'");
        var_dump(count($exist_user_act));
        if (count($exist_user_act) == 0 ){
            $user_act->user_id = $user_id;
            $user_act->action_id =$action_id;
            $user_act->count_times = 1;
            $user_act->create();
        } else {
            $user_act->id = $exist_user_act[0]->id;
            $user_act->user_id = $exist_user_act[0]->user_id;
            $user_act->action_id = $exist_user_act[0]->action_id;
            $user_act->count_times = $exist_user_act[0]->count_times + 1;
            $user_act->update();
        }
        $user_act->redirect($_SERVER['HTTP_REFERER']);

    }

    public function logout(){
        $session = new Session();
        $session->logout();
        $User = new User();
        $User->redirect('index.php');
    }




}



$frontController = new FrontController();