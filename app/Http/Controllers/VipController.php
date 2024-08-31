<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Vip;
use Illuminate\Support\Facades\DB;

class VipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vips=DB::table('vips')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.vips.index', compact('vips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.vips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        Vip::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        $vip = Vip::findOrFail($id);
        $input = $request->all();
       
        $vip->update([
           'role_name' => $input['role_name'],
           'commession_percent' => $input['commession_percent'],
        ]);
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vip= Vip::findOrFail($id);
        $vip->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
