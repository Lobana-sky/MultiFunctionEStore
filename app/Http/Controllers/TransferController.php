<?php

namespace App\Http\Controllers;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    { 
        $transfers=DB::table('transfers')->select('*')->orderBy('id', 'desc')->paginate(500);
        
           return view('backend.transfer.index', compact('transfers'));
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
                $name = 'transfer'.time().$file->getClientOriginalName();
                $file->move('assets/images/transfer/', $name);
                $input['image'] = $name;
             }
        }
        else
        {
         $input['image']= "";
        }
         Transfer::create($input);
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
        $transfer = Transfer::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
        {
           if ($file = $request->file('image')) {
               $name = 'transfer'.time().$file->getClientOriginalName();
               $file->move('assets/images/transfer/', $name);
               $input['image'] = $name;
            }
       }
       else
       {
        $input['image']= $transfer['image'];
       }
        $transfer->update($input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transfer= Transfer::findOrFail($id);
        $transfer->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
