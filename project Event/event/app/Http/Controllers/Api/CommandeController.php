<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommandRequest;
use App\Http\Resources\CommandResource;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommandResource::collection(Commande::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandRequest $request)
    {
        //
        $commande=Commande::create($request->validated());
        return response()->json([
            'message'=>'command is store',
            'commande'=>$commande
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(string $userdeid,string $eventdeid)
    {
        $commande=Commande::where('user_id',$userdeid)->where('event_id',$eventdeid)->first();
        return new CommandResource($commande);
    }

    
    //commande from event
    public function cmd_event(string $eventdeid)
    {
        $commande=Commande::where('event_id',$eventdeid)->get();
        $users=User::join('commandes','users.id','=','commandes.user_id')
                    ->join('events','events.id','=','commandes.event_id')
                    ->where('events.id','=',$eventdeid)->get();
        return CommandResource::collection($users);
        // return response()->json([
        //     'message'=>'hiw'
        // ]);
    }

     //commande from event
    public function cmd_user(string $userdeid)
    {
        $commande=Commande::where('user_id',$userdeid)->get();
        return new CommandResource($commande);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(CommandRequest $request, string $userdeid,string $eventdeid)
    {
        Commande::where('user_id',$userdeid)->where('event_id',$eventdeid)->update(['qte'=>$request->qte]);
        // $commande->update($request->validated());
        return new CommandResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy( string $userdeid,string $eventdeid)
    {
        Commande::where('user_id',$userdeid)->where('event_id',$eventdeid)->delete();
        // $commande->delete();
        return response()->json([
            'message'=>'commande is deleted'
        ]);
    }
}
