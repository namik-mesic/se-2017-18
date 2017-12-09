<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2017
 * Time: 19:00
 */

namespace App\Http\Controllers;


use App\Event;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Support\Facades\Input;
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

        $event->delete();
        return Redirect::to('event');
    }
    public function store(CreateEventRequest $request)
    {
        $data = $request->all();

        $event = Event::query()->create($data);

        return redirect('event');
    }

}