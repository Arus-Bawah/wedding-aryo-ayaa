<?php namespace App\Repository;

use App\Models\CommentsModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CommentsRepository
{
    /**
     * @param $id
     * @return Builder|Model|object|null
     */
    public static function findExistById($id)
    {
        return CommentsModel::query()
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $latest_id
     * @return Builder[]|Collection
     */
    public static function getComment($latest_id)
    {
        return CommentsModel::query()
            ->select('id', 'created_at', 'invitation_id', 'invitation_name as name', 'invitation_location as location', 'message')
            ->where(function ($q) use ($latest_id) {
                if ($latest_id > 0) {
                    $q->where('id', '<', $latest_id);
                }
            })
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
    }

    /**
     * @param $invitation_id
     * @param $name
     * @param $location
     * @param $message
     * @return int
     */
    public static function saveComment($invitation_id, $name, $location, $message)
    {
        return CommentsModel::query()->insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'invitation_id' => $invitation_id,
            'invitation_name' => $name,
            'invitation_location' => $location,
            'message' => $message,
        ]);
    }

    /**
     * @param $id
     * @param $message
     * @return int
     */
    public static function updateComment($id, $message)
    {
        return CommentsModel::query()
            ->where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'message' => $message,
            ]);
    }
}
