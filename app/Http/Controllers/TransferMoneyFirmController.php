<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\TransferMoneyFirm;
use Illuminate\Support\Facades\DB;

class TransferMoneyFirmController extends Controller
{

    public function index()
    {
        $transferMoneyFirms=DB::table('transfer_money_firms')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.transferMoneyFirms.index', compact('transferMoneyFirms'));
    }

    public function create()
    {
        return view('backend.transferMoneyFirms.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
       
         if($request->file('image')!="")
         {
            if ($file = $request->file('image')) {
                $name = 'app'.time().$file->getClientOriginalName();
                $file->move('assets/images/TransferMoneyFirm/', $name);
                $input['image'] = $name;
             }
        }
        else
        {
         $input['image']= "";
        }
        TransferMoneyFirm::create($input);
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
        $transferMoneyFirm = TransferMoneyFirm::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
        {
           if ($file = $request->file('image')) {
               $name = 'app'.time().$file->getClientOriginalName();
               $file->move('assets/images/TransferMoneyFirm/', $name);
               $input['image'] = $name;
            }
       }
       else
       {
        $input['image']= $transferMoneyFirm['image'];
       }
        $transferMoneyFirm->update($input);
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy( $id)
    {
        $transferMoneyFirm= TransferMoneyFirm::findOrFail($id);
        $transferMoneyFirm->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
