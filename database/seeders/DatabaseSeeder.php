<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
        $desk = \App\Models\Desk::factory()->create();
        $list = \App\Models\Lists::factory()->create(['desk_id' => $desk->id]);
        $card = \App\Models\Card::factory()->create(['list_id' => $list->id]);
        $task = \App\Models\Task::factory()->create(['card_id' => $card->id]);
    }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
