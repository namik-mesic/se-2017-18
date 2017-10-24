<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2017
 * Time: 19:43
 */

namespace App\Http\Controllers;


use App\EventInvitation;

class EventInvitationsController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $eventInvitations = EventInvitation::all();

        return view('eventInvitations.index', compact(
            'eventInvitations'
        ));
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