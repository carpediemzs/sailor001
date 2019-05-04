<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取所有用户集合和第一个用户
        $users = User::all();
        $user = User::first();
        $user_id = $user->id;

        //获取除第一个用户以外的所有用户的集合
        $followers = $users->slice($user_id);
        $follower_ids = $followers->pluck('id')->toArray();

        //第一个用户关注除了第一用户以外的所有用户
        $user->follow($follower_ids);

        //除第一个用户以外，其他所有用户均关注第一个用户
        foreach($followers as $follower){
            $follower->follow($user_id);
        }
    }
}
