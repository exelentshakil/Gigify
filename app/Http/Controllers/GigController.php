<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gig;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gigs = Gig::with('user')->where('freelancer_id', auth()->user()->id)->get();
        $categories = Category::all();
        return Inertia::render('Gigs/Index', [
            'gigs' => $gigs,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return inertia('Gigs/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

       Gig::create([
           'title' => $request->title,
           'description' => $request->description,
           'price' => $request->price,
           'category_id' => $request->category_id,
           'freelancer_id' => auth()->user()->id
       ]);

       return redirect(route('gigs.index'))->with('message', 'Gig added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Gig $gig)
    {
        return inertia('Gigs/Show', compact('gig') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gig $gig)
    {
        $categories = Category::all();
        return inertia('Gigs/Edit', compact("gig", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gig $gig)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $gig->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'freelancer_id' => auth()->user()->id
        ]);

        return redirect(route('gigs.edit', $gig->id))->with('message', 'Gig updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gig $gig)
    {
        $this->authorize('delete', $gig);

        $gig->delete();
        return redirect(route('gigs.index'))->with('message', 'Gig deleted successfully!');

    }
}
