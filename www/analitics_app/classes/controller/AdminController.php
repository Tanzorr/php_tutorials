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

        public function deleteUser($id) {
            $user = new User();
            $user = $user->find_by_id($id);
            $user->delete();
            $user->redirect( $_SERVER['HTTP_REFERER']);
        }

        public function allActions() {
            $action = new Action();
            return $action->find_all();
        }

        public function getUser($id) {
            $user = new User();
            $user = $user->find_by_id($id);
            return $user;
        }


        public function addAction($request) {
            if (!empty( $request['name']) ) {
                $action = new Action();
                $action->name = $request['name'];
                $action->create();
                $action->redirect('add_action.php');
            }
        }

        public function deleteActon($id) {
            $action =  new Action();
            $action = $action->find_by_id($id);
            $action->delete();
            $action->redirect( $_SERVER['HTTP_REFERER']);
        }

        public function getAllUsersActions ($user_id) {
            $user_actions = new Services();
            $user_actions = $user_actions->getUsersAction($user_id);
            return $user_actions;
        }


}


$adminController = new AdminController();