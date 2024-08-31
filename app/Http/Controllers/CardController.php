<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Card;
use Illuminate\Support\Facades\DB;
class CardController extends Controller
{

    public function index()
    { 
        $cards=DB::table('cards')->select('*')->orderBy('id', 'desc')->paginate(500);
        
           return view('backend.card.index', compact('cards'));
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
                $name = 'card'.time().$file->getClientOriginalName();
                $file->move('assets/images/card/', $name);
                $input['image'] = $name;
             }   
        }
        else
        {
         $input['image'] ="";
        }
        Card::create($input);
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
        $card = Card::findOrFail($id);
      
        $input = $request->all();

        if($request->file('image')!="")
        {
        if ($file = $request->file('image')) {
            $name = 'card'.time().$file->getClientOriginalName();
            $file->move('assets/images/card/', $name);
            $input['image'] = $name;
        }  $input['image'] = $name;
            
       }
       else
       {
        $input['image'] =$card['image'];
       }
        $card->update( $input   );
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $card= Card::findOrFail($id);
        $card->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
