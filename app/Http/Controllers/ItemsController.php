<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Section;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Item $products)
    {
        $sections = Section::all();
        $products = Item::all();
        return view('theProducts')->with('products', $products)->with('sections', $sections);
        // $products = DB::table('items')->get();

        // return view('AllProducts.theProducts', ['products' => $products]);
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
            'item_name' => 'required|unique:items|max:255',
            'description' => 'required',
            'section_id' => 'required']
            , [
                'item_name.required' => 'يرجى إدخال اسم المنتج',
                'item_name.unique' => 'هذا المنتج موجود من قبل',
                'description.required' => 'يرجى إدخال وصف المنتج',
                'section_id' => 'يرجى اختيار القسم',
            ]);
        Item::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);
        session()->flash('Add', 'تمت الإضافة بنجاح');
        return redirect('/items/index');
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
    public function update(Request $request, Item $product)
    {
        $id = Section::where('section_name', $request->section_name)->first()->id;
        $product = Item::findOrFail($request->id);
        $validated = $request->validate([
            'item_name' => 'required|max:255' . $id,
            'description' => 'required',]
            , [
                'item_name.required' => 'يرجى إدخال اسم المنتج',
                'description.required' => 'يرجى إدخال وصف المنتج',
            ]);

        $product->update([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);

        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('/items/index');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Item::findOrFail($request->id);
        $product->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
    }
}
