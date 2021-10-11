<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class notificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = DB::table('friends')->get();
        foreach ($data as $d) {
            $str = "{";
            $str .= "\"user_id\":";
            $str .= $d->user_id;
            $str .= ",\"friend_id\":";
            $str .= $d->friend_id;
            $str .= "}";
            DB::table('notifications')->insert([
                'type' => 'App\Notifications\Friendship',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $d->friend_id,
                'data' => $str,
            ]);
        }
    }
}
