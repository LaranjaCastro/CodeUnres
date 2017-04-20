<?php

namespace App\Http\Model\Web\Backend;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'admin_user';
    public $timestamps = false;

    public function get($name)
    {
        $user_info = AdminUser::where('name', $name)->first();
        if (! empty($user_info)) {
            $user_info = $user_info->toArray();
        }

        return $user_info;
    }
}
