<?php namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tmp_slug = [];
        $same_slug = [];
        $file = file_get_contents(base_path('database/invitation/invitation.json'));
        $json = json_decode($file);
        foreach ($json->data as $row) {
            $check = DB::table('invitation')
                ->where('name', '=', $row->nama)
                ->where('location', '=', $row->alamat)
                ->count();
            if ($check === 0) {
                $url = Str::slug($row->nama);
                if (in_array($url, $tmp_slug)) {
                    $url = Str::slug($row->nama . '-' . $row->alamat);
                    $same_slug[] = $url;
                }
                $tmp_slug[] = $url;

                DB::table('invitation')->insert([
                    'created_at' => date('Y-m-d H:i:s'),
                    'name' => $row->nama,
                    'location' => $row->alamat,
                    'url' => $url,
                    'sesi' => 1,
                    'is_invite' => 1
                ]);
            }
        }

        dd($same_slug);
    }
}
