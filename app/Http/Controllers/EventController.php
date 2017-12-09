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

    public function store(CreateEventRequest $request)
    {
        $data = $request->all();

        $event = Event::query()->create($data);

        return redirect('event');
    }

}