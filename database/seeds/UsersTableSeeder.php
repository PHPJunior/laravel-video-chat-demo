<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpJunior\LaravelVideoChat\Models\Conversation\Conversation;
use PhpJunior\LaravelVideoChat\Models\Group\Conversation\GroupConversation;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)->create();

        $conversation = new Conversation();
        $conversation->first_user_id = 1;
        $conversation->second_user_id = 2;
        $conversation->save();

        $conversation->messages()->create([
            'user_id'   => 1,
            'text'      => 'Hello'
        ]);

        $group = new GroupConversation();
        $group->name = 'Test';
        $group->save();

        $group->users()->attach([ 1,2,3,4 ]);
    }
}
