<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EventResource(Event::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //add
        if($user=User::where('id',$request->user_id)->exists())
        {
            $event=Event::create($request->validated());
            return new EventResource($event);
        }
        return response()->json([
            'message'=>'user not exist'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(string $event)
    {
        //
        $even=Event::where('id',$event)->get();
        return new EventResource($even);
    }

    /**
     *    public function show(Event $event)
    {
        return new EventResource($event);
    }
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, string $eventid)
    {
        //update
        $event=Event::where('id',$eventid)->first();
        $event->update($request->validated());
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy( string $eventid)
    {
        $event=Event::where('id',$eventid)->delete();
        return response()->json([
            'message'=>'Event is deleted'
        ]);
    }
}
