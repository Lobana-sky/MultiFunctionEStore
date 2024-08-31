<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameSection;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
class GameController extends Controller
{
    public function index()
    { 
        $games=DB::table('games')->select('*')->orderBy('id', 'desc')->paginate(500);
        
        $games_sections=DB::table('game_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.games.index', compact('games','games_sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
       
         if($request->file('image')!="")
         {
            if ($file = $request->file('image')) {
                $name = 'game'.time().$file->getClientOriginalName();
                $file->move('assets/images/game/', $name);
                $input['image'] = $name;
             }
        }
        else
        {
         $input['image']= "";
        }
        Game::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Game::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
        {
           if ($file = $request->file('image')) {
               $name = 'game'.time().$file->getClientOriginalName();
               $file->move('assets/images/game/', $name);
               $input['image'] = $name;
            }
       }
       else
       {
        $input['image']= $game['image'];
       }
        $game->update( $input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game= Game::findOrFail($id);
        $game->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }}
