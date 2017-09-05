<?php
namespace app\api\controller\v2;

use app\api\model\User as UserModel;

class User
{
    public function read($id = 0)
    {
        $user = UserModel::get($id, 'profile');
        if ($user) {
            return json($user);
        } else {
            return json(['error'=>'user dosen\'t exist.'], 404);
        }
    }

}
