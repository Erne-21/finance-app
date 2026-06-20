<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories = auth()->user()->categories()->latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required', 'type' => 'required|in:income,expense']);
        auth()->user()->categories()->create($request->only('name', 'type'));
        return redirect()->route('categories.index')->with('success', 'Category added!');
    }

    public function update(Request $request, Category $category) {
        $this->authorize('update', $category); // optional policy
        $category->update($request->only('name', 'type'));
        return redirect()->route('categories.index')->with('success', 'Updated!');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Deleted!');
    }
}