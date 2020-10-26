<?php


class AdminController
{
    public function allUsers() {
        $user = new User();
        return $user->find_all();
    }
    public function addUser($request) {
        if (!empty( $request['name']) && !empty($request['email']) && !empty('role') && !empty($request['password'])) {
            $user = new User();
            $user->name = $request['name'];
            $user->role = $request['role'];
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->create();
            $user->redirect('add_user.php');

          }
        }

        public function addAction($request) {
            if (!empty( $request['name']) ) {
                $action = new Action();
                $action->name = $request['name'];
                $action->create();
                $action->redirect('add_action.php');
            }
        }


}


$adminController = new AdminController();