<?php namespace App\Http\Controllers;

use App\Http\Requests\GetCommentRequest;
use App\Http\Requests\InvitationSaveRequest;
use App\Http\Requests\SaveCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repository\ActivityRepository;
use App\Repository\CommentsRepository;
use App\Repository\InvitationRepository;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MainController extends Controller
{
    public function Index()
    {
        // main variable
        $invitation_id = Session::get('invitation_id');
        $name = Session::get('name');
        $location = Session::get('location');
        $sesi = Session::get('sesi') ?: 0;

        // put session
        $this->SetSession($invitation_id, $name, $location, $sesi);

        // save logs/activity
        ActivityRepository::saveActivity($invitation_id, 'Home-Index');

        return view('template.main', [
            'id' => $invitation_id,
            'name' => $name,
            'location' => $location,
            'sesi' => $sesi,
            'time_session_start' => 13,
            'time_session_end' => 22,
            'token' => csrf_token(),
        ]);
    }

    public function Invitation($slug)
    {
        // main variable
        $invitation_id = null;

        // find data
        $data = InvitationRepository::findExistBySlug($slug);
        if ($data) {
            $invitation_id = $data->id;

            // save session
            $this->SetSession($data->id, $data->name, $data->location, $data->sesi, true);
        }

        // save logs/activity
        ActivityRepository::saveActivity($invitation_id, 'Invitation');

        return redirect('/');
    }

    public function saveInvitation(InvitationSaveRequest $request)
    {
        // main variable
        $name = $request->input('name');
        $location = $request->input('location');
        $slug = Str::of($name)->slug();

        $check_invitation = InvitationRepository::findExistBySlug($slug);
        if ($check_invitation) {
            // save logs/activity
            ActivityRepository::saveActivity($check_invitation->id, 'InvitationSave');

            // save session
            $this->SetSession($check_invitation->id, $check_invitation->name, $check_invitation->location, 0, true);

            // save logs parameter
            $this->LogsParameter('invitation-request', 'InvitationSaveRequest');

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'token' => csrf_token(),
                'data' => [
                    'id' => $check_invitation->id,
                    'name' => $check_invitation->name,
                    'location' => $check_invitation->location,
                    'sesi' => 0,
                ]
            ], 200);
        } else {
            // save data
            $id = InvitationRepository::saveInvitation($name, $location);

            // send response
            if ($id) {
                // save logs/activity
                ActivityRepository::saveActivity($id, 'InvitationSave');

                // save session
                $this->SetSession($id, $name, $location, true);

                // save logs parameter
                $this->LogsParameter('invitation-request', 'InvitationSaveRequest');

                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'token' => csrf_token(),
                    'data' => [
                        'id' => $id,
                        'name' => $name,
                        'location' => $location,
                    ]
                ], 200);
            } else {
                // save logs/activity
                ActivityRepository::saveActivity(null, 'InvitationSave');

                // save logs parameter
                $this->LogsParameter('invitation-request', 'InvitationSaveRequest', 'warning');

                return response()->json([
                    'status' => false,
                    'message' => 'Failed insert data',
                    'token' => csrf_token(),
                ], 401);
            }
        }
    }

    public function getComment(GetCommentRequest $request)
    {
        // main variable
        $invitation_id = Session::get('invitation_id');

        // save logs/activity
        ActivityRepository::saveActivity($invitation_id, 'Comment');

        // save logs parameter
        $this->LogsParameter('comment-get-request', 'Comment');

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'token' => csrf_token(),
            'data' => CommentsRepository::getComment($request->get('latest_id'))
        ], 200);
    }

    public function saveComment(SaveCommentRequest $request)
    {
        // main variable
        $session_invitation_id = Session::get('invitation_id');
        $session_name = Session::get('name');
        $session_location = Session::get('location');
        $message = $request->input('comment');

        // save data
        $id = CommentsRepository::saveComment($session_invitation_id, $session_name, $session_location, $message);

        // send response
        if ($id) {
            // save logs/activity
            ActivityRepository::saveActivity($session_invitation_id, 'CommentSave');

            // save logs parameter
            $this->LogsParameter('comment-save-request', 'CommentSaveRequest');

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'token' => csrf_token(),
                'data' => [
                    'id' => $id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'invitation_id' => $session_invitation_id,
                    'name' => $session_name,
                    'location' => $session_location,
                    'message' => $message

                ]
            ], 200);
        } else {
            // save logs/activity
            ActivityRepository::saveActivity($session_invitation_id, 'CommentSave');

            // save logs parameter
            $this->LogsParameter('comment-save-request', 'CommentSaveRequest', 'warning');

            return response()->json([
                'status' => false,
                'message' => 'Failed insert data',
                'token' => csrf_token(),
            ], 401);
        }
    }

    public function updateComment(UpdateCommentRequest $request, $id)
    {
        // main variable
        $session_invitation_id = Session::get('invitation_id');
        $session_name = Session::get('name');
        $session_location = Session::get('location');
        $message = $request->input('comment');

        $comment = CommentsRepository::findExistById($id);
        if (!$comment) { // validate existing data
            // save logs/activity
            ActivityRepository::saveActivity($session_invitation_id, 'CommentUpdate');

            // save logs parameter
            $this->LogsParameter('comment-update-request', 'CommentUpdateRequest', 'warning');

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'token' => csrf_token(),
            ], 401);

        } elseif ($comment->invitation_id != $session_invitation_id) { // validate invitation
            // save logs/activity
            ActivityRepository::saveActivity($session_invitation_id, 'CommentUpdate');

            // save logs parameter
            $this->LogsParameter('comment-update-request', 'CommentUpdateRequest', 'warning');

            return response()->json([
                'status' => false,
                'message' => 'Invalid User',
                'token' => csrf_token(),
            ], 401);

        } else {
            // update data
            $act = CommentsRepository::updateComment($id, $message);

            // send response
            if ($act) {
                // save logs/activity
                ActivityRepository::saveActivity($session_invitation_id, 'CommentUpdate');

                // save logs parameter
                $this->LogsParameter('comment-update-request', 'CommentUpdateRequest');

                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'token' => csrf_token(),
                    'data' => [
                        'id' => $id,
                        'created_at' => $comment->created_at,
                        'invitation_id' => $session_invitation_id,
                        'name' => $session_name,
                        'location' => $session_location,
                        'message' => $message

                    ]
                ], 200);
            } else {
                // save logs/activity
                ActivityRepository::saveActivity($session_invitation_id, 'CommentUpdate');

                // save logs parameter
                $this->LogsParameter('comment-update-request', 'CommentUpdateRequest', 'warning');

                return response()->json([
                    'status' => false,
                    'message' => 'Failed insert data',
                    'token' => csrf_token(),
                ], 401);
            }
        }
    }

    ################ HELPERS METHOD ################

    /**
     * @param $path
     * @param $filename
     * @param string $type
     * @return bool
     */
    private function LogsParameter($path, $filename, $type = 'info')
    {
        try {
            // main variable
            $log_message = request()->fullUrl();
            $log_data = request()->all();
            $log_file = 'logs/' . $path . '/' . date('Y-m/d/') . $filename . '.log';
            $log_path = storage_path($log_file);

            //save log file
            $log = new Logger($filename);
            $log->pushHandler(new StreamHandler($log_path, Logger::INFO));

            // log type
            switch ($type) {
                case 'error':
                    $log->error($log_message, $log_data);
                    break;
                case 'warning':
                    $log->warning($log_message, $log_data);
                    break;
                default:
                    $log->info($log_message, $log_data);
                    break;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $invitation_id
     * @param $name
     * @param $location
     * @param $sesi
     * @param false $force
     * @return bool
     */
    private function SetSession($invitation_id, $name, $location, $sesi, $force = false)
    {
        $session_invitation_id = Session::get('invitation_id');
        $session_name = Session::get('name');
        $session_location = Session::get('location');

        // session has set
        if (($session_invitation_id != '' && $session_name != '' && $session_location != '') && !$force) {
            return true;
        }

        // put new session
        Session::put('invitation_id', $invitation_id);
        Session::put('name', $name);
        Session::put('location', $location);
        Session::put('sesi', $sesi);

        return true;
    }

    private function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", request()->userAgent());
    }
}
