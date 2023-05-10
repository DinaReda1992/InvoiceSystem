<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',]
            ,[
                'section_name.required' => 'يرجى إدخال اسم القسم',
                'section_name.unique' => 'هذا القسم موجود من قبل',
                'description.required' => 'يرجى إدخال وصف القسم',
            ]);
            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'createdBy' => (Auth::user()->name)
            ]);
            session()->flash('Add','تمت الإضافة بنجاح');
            return redirect('/sections/index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        {
            $id = $request->id;

            $this->validate($request, [

                'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
                'description' => 'required',
            ],[

                'section_name.required' =>'يرجي ادخال اسم القسم',
                'section_name.unique' =>'اسم القسم مسجل مسبقا',
                'description.required' =>'يرجي ادخال الوصف',

            ]);

            $section = Section::find($id);
                $section->section_name = $request->section_name;
                $section->description = $request->description;
                $section->save();

            session()->flash('edit','تم تعديل القسم بنجاح');
            return redirect('/sections/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections/index');
    }
}
