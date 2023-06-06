<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_Detail;
use Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();
        User_Detail::truncate();

        $user_admin = User::create([
            'name_surname'=>'Hüseyin Babür',
            'email'=>'babur@eticaret.test',
            'password'=>bcrypt('123456'),
            'is_active'=>1,
            'is_admin'=>1
        ]);
        $user_admin->detail()->create([
            'address'=>'Ankar',
            'phone'=>'(332) 352 52 49',
            'mobile_phone'=>'(536) 258 58 47'
        ]);

        for($i=0;$i<50;$i++)
        {
            $user = User::create([
                'name_surname'=>$faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password'=>bcrypt('123456'),
                'is_active'=>1,
                'is_admin'=>0
            ]);
            $user->detail()->create([
                'address'=>$faker->address,
                'phone'=>$faker->e164PhoneNumber,
                'mobile_phone'=>$faker->e164PhoneNumber
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
