<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Program;
use Illuminate\Support\Facades\DB;
class ProgramController extends Controller
{
    
    public function index()
    { 
        $programs=DB::table('programs')->select('*')->orderBy('id', 'desc')->paginate(500);
        
           return view('backend.program.index', compact('programs'));
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
                $name = 'program'.time().$file->getClientOriginalName();
                $file->move('assets/images/program/', $name);
                $input['image'] = $name;
             }
        }
        else
        {
         $input['image']= "";
        }
        Program::create($input);
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
        $program = Program::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
         {
            if ($file = $request->file('image')) {
                $name = 'program'.time().$file->getClientOriginalName();
                $file->move('assets/images/program/', $name);
                $input['image'] = $name;
             }
        }
        else
        {
         $input['image']= $program['image'];
        }
        $program->update($input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program= Program::findOrFail($id);
        $program->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
