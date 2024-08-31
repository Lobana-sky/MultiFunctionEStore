<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Turkification;
use Illuminate\Support\Facades\DB;

class TurkificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $turkifications=DB::table('turkifications')->select('*')->orderBy('id', 'desc')->paginate(500);
       //User::all()->paginate(500);
       return view('backend.turkifications.index', compact('turkifications'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $current_user = User::firstOrFail($id);
        // $current_user = 1;
        dd($current_user);
        return view('backend.turkifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $current_user =1;
        // $current_user = User::firstOrFail($id);
        
        $input = $request->all();

        Turkification::create($input);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $turkification = Turkification::findOrFail($id);
        $input = $request->all();
        $turkification->update([
        'ime' => $input['ime'],
        ]);
        
        return back()->with('message', 'تم التعديل بنجاح');

        //if faile?

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $turkification= Turkification::findOrFail($id);
        $turkification->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
