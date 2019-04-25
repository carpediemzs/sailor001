<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();

        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->update(['name'=>'sailor001', 'email'=>'sailor001@126.com', 'is_admin'=>true]);
        //$user->name = 'sailorzs';
        //$user->email = 'sailorzs@126.com';
        //$user->save();
    }
}
