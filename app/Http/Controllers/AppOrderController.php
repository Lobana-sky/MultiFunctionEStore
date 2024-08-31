<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\AppOrder;
use Illuminate\Support\Facades\DB;

class AppOrderController extends Controller
{

    public function index()
    {
        $appOrders=DB::table('app_orders')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.appOrders.index', compact('appOrders'));
    }

    public function create()
    {
        return view('backend.appOrders.create');

    }

    public function store(Request $request)
    {
        $input = $request->all();
        AppOrder::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function show( $id)
    {
    }

    public function edit( $id)
    {
    }

    public function update(Request $request,  $id)
    {
        $appOrder = AppOrder::findOrFail($id);
        $input = $request->all();
       
        $appOrder->update([
           'app_id' => $input['app_id'],
           'user_id' => $input['user_id'],
           'count' => $input['count'],
        ]);
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy( $id)
    {
        $appOrder= AppOrder::findOrFail($id);
        $appOrder->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
