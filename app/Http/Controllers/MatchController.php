<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Matchs;
use App\Http\Resources\Match as MatchResource;

class matchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get matchs
        $matchs = Matchs::orderBy('created_at','desc')->paginate(5);
        //return collection of matchs as a resource
        return MatchResource::collection($matchs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $match = $request->isMethod('put') ? Matchs::findOrFail
        ($request->match_id) : new Matchs;
        $match->id = $request->input('match_id');
        $match->status = $request->input('status');
        $match->matchday = $request->input('matchday');

        if($match->save()){
            return new MatchResource($match);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get specific match
        $match = Matchs::findOrFail($id);

        //return the single match as a resource
        return new MatchResource($match);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get specific match
        $match = Matchs::findOrFail($id);

        if ($match->delete()){
            return new MatchResource($match);
        }
    }
}
