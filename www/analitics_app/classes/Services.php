<?php


class Services
{
    public function getUsersAction($user_id) {
        global $database;
        $sql = "SELECT actios.name, users_action.count_times FROM users_action 
                                            LEFT JOIN actios ON users_action.action_id = actios.id 
                                             WHERE users_action.user_id = '{$user_id}'";
        $result_set =$database->query($sql);
        while ($row = mysqli_fetch_assoc($result_set)){
            $res_arr[] =$row;
        }

        return $res_arr;

    }

}