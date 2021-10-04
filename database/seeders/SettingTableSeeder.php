<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'description'=>"Test Description",
            'short_des'=>"Test Short Description",
            'photo'=>"images/store/logo.png",
            'logo'=>'images/store/logo.png',
            'address'=>"This is test address",
            'email'=>"shop@gmail.com",
            'phone'=>"111-111-111",
        );
        DB::table('settings')->insert($data);
    }
}
