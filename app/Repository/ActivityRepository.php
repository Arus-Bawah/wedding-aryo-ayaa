<?php namespace App\Repository;

use App\Models\ActivityModel;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    // main object
    private static $table = 'activity';

    /**
     * @param $invitation_id
     * @param $activity_name
     * @return int
     */
    public static function saveActivity($invitation_id, $activity_name)
    {
        return DB::table(static::$table)->insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'invitation_id' => $invitation_id,
            'activity' => $activity_name,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
