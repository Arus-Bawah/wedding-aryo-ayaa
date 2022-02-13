<?php namespace App\Repository;


use App\Models\InvitationModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvitationRepository
{
    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function findExistBySlug($slug)
    {
        return InvitationModel::query()
            ->where('url', $slug)
            ->first();
    }

    /**
     * @param $id
     * @return Builder|Model|object|null
     */
    public static function findExistingById($id)
    {
        return InvitationModel::query()
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $name
     * @param $location
     * @return int
     */
    public static function saveInvitation($name, $location)
    {
        return InvitationModel::query()->insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'name' => $name,
            'location' => $location,
            'url' => Str::of($name)->slug(),
            'sesi' => 0,
        ]);
    }
}
