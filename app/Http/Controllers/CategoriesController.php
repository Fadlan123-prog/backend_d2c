<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::withCount('items')->get();
        return view('page.category.index', compact('categories'));
    }

    public function create(){
        return view('page.category.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'categories.categories_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $categories = new Categories();
            $categories->categories_name = $validateData['categories']['categories_name'];
            $categories->save();

            DB::commit();

            return redirect()->route('items.category')->with('success', 'Category berhasil disimpan!');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('items.category')->withErrors(['error' => 'Terjadi Kesalahan saat menyimpan Category' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id){
        $categories = Categories::findOrFail($id);

        return view('page.category.edit', compact('categories'));
    }

    public function update(Request $request, Categories $categories){
        $request->validate([
            'categories.categories_name' => 'required|string|max:225',
        ]);

        $categories->update($request->categories);

        return redirect()->route('items.category')->with('success', 'Category Updated successfully');
    }

    public function destroy($id){
        $categories = Categories::find($id);
        if($categories){
            $categories->delete();
            return redirect()->route('items.category')->with('success', 'Category Deleted successfully');
        }

        return redirect()->route('items.category')->with('error', 'Category not found');
    }
}
