<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2017
 * Time: 19:43
 */

namespace App\Http\Controllers;


use App\EventInvitation;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventInvitationsController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $eventInvitations = DB::table('event_invitations')
            ->select('event_invitations.id as id', 'events.name as name', 'event_invitations.response')
            ->where('event_invitations.user_id', '=', Auth::user()->id)
            ->orderBy('event_invitations.created_at', 'DESC')
            ->join('events', 'event_invitations.event_id', '=', 'events.id')
            ->get();
            //EventInvitation::all();
            //DB::table('event_invitations')->where('user_id','=', 1); // replace with user id from session

        return view('eventInvitations.index', compact(
            'eventInvitations'
        ));
    }

    public function response(int $id, string $response) {
        $event_invitation = EventInvitation::find($id);
        $event_invitation->response = $response;
        $event_invitation->save();

        return redirect('invitations');

    }

    /**
     * @return View
     */
    public function create()
    {
        return view('eventInvitations.create');
    }

    public function store(FormRequest $request)
    {
        $data = $request->all();

        $eventInvitations = EventInvitation::query()->create($data);

        return redirect('index');
    }
}