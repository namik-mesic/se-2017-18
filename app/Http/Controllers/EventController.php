<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2017
 * Time: 19:00
 */

namespace App\Http\Controllers;


use App\Event;
use App\EventInvitation;
use App\Http\Requests\CreateEventRequest;
use App\InvitedUser;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $events = Event::all();
        $events = DB::table('events')
            ->select('*')
            ->where('events.user_id', '=', Auth::user()->id)
            ->orderBy('events.created_at', 'desc')
            ->get();

        return view('event.index', compact(
            'events'
        ));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * @return View
     */
    public function edit(int $id)
    {
        $event = Event::find($id);

        return view('event.edit', compact(
            'event'
        ));
    }

    public function update(int $id) {
            $event = Event::find($id);
            $event->name = Input::get('name');
            $event->description = Input::get('description');
            $event->place = Input::get('place');
            $event->date = Input::get('date');
            $event->hour = Input::get('hour');
            $event->save();

            // redirect
            Session::flash('message', 'Successfully updated event!');
            return Redirect::to('event');
    }

    public function show(int $id) {
        $event = Event::find($id);
        return view('event.show', compact(
            'event'
        ));
    }

    public function destroy(int $id) {
        $event = Event::find($id);

        EventInvitation::query();

        DB::table('event_invitations')
        ->where('event_invitations.event_id', '=', $id)
        ->delete();

        $event->delete();
        return Redirect::to('event');
    }
    public function store(CreateEventRequest $request)
    {
        //$request->user_id = Auth::user()->id;
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        //$data->user_id = Auth::user()->id;
        $event = Event::query()->create($data);

        return redirect('event');
    }

    public function sendInvitations(int $event_id) {
        $users = User::all();
        $eventInvitation = new EventInvitation();
        foreach ($users as $user) {
            $eventInvitation->event_id = $event_id;
            $eventInvitation->user_id = $user->id;
            $eventInvitation->response = "";
            $eventInvitation->save();
        }

        return redirect('event');
    }

    public function sendInvitation(int $event_id, int $user_id) {
        $eventInvitation = new EventInvitation();
            $eventInvitation->event_id = $event_id;
            $eventInvitation->user_id = $user_id;
            $eventInvitation->response = "";
            $eventInvitation->save();


        $user = User::find($user_id);
        $event = Event::find($event_id);

        $this->sendEmailInvitation($user, $event) ;

        return redirect('event/' . $event_id . '/invite');
    }

    public function sendEmailInvitation($user, $event){
        $data = array('name'=>$user->name, 'event'=>$event);

        Mail::send(['text'=>'mail'], $data, function($message) use ($event, $user) {
            $message->to($user->email, $user->name)->subject
            ($event->name . ' Event Invitation');
            $message->from('ssst.events@gmail.com','SSST Events');
        });
    }

    public function invite(int $event_id) {
        $users = User::all();
        $invitedUsers = array();

        foreach ($users as  $index =>$user) {
            $eventInvitation = DB::table('event_invitations')
                ->select('event_invitations.id as id', 'event_invitations.response as response')
                ->where('event_id', '=', $event_id)
                ->where('user_id', '=', $user->id)
                ->get();
            $eventInvitation = $eventInvitation->values();
            $invitedUser = new InvitedUser();
            $invitedUser->id = $user->id;
            $invitedUser->name  = $user->name;
            if(!empty ( $eventInvitation ) && count($eventInvitation) > 0) {
                $invitedUser->invited = true;
                $invitedUser->response = $eventInvitation->get(0)->response;
            }
            else $invitedUser->invited = false;
            $invitedUsers[$index] = $invitedUser;
            //array_add($invitedUsers, $invitedUser->id,$invitedUser);
        }

        return view('event.invite', compact(
            'invitedUsers', 'event_id'
        ));
    }

}