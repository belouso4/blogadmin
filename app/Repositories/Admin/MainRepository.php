<?php


namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;

class MainRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public static function getCountUsers()
    {
        return \DB::table('users')
            ->get()
            ->count();
    }

    public static function getCountOrders()
    {
        $count = \DB::table('orders')
            ->where('status', '0')
            ->get()
            ->count();
        return $count;
    }

    public static function getCountPosts()
    {
        $count = \DB::table('posts')
            ->get()
            ->count();
        return $count;
    }
}
