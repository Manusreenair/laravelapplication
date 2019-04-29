<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user=new\App\User();
        $user->name="Superadmin";
        $user->email="manulakshmi@gmail.com";
        $user->password=\Illuminate\Support\Facades\Hash::
        make("Password123");
        $user->phone_no="9994980524";
        $user->status="0";
        $user->created_by="1";
        $user->save();
    }
}   
