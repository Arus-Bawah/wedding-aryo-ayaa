<?php namespace Database\Seeders;

use App\Repository\CommentsRepository;
use App\Repository\InvitationRepository;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 35; $i++) {
            $invitation_id = rand(1, 3);
            $invitation = InvitationRepository::findExistingById($invitation_id);
            $faker = Faker::create('id_ID');
            CommentsRepository::saveComment($invitation->id, $invitation->name, $invitation->location, $faker->text);
        }
    }
}
