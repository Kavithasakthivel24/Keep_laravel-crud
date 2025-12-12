<?php

namespace App\Http\Controllers;

use App\Models\Keep;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeepsExport;
use App\Imports\KeepsImport;

class KeepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $keeps = Keep::latest()->paginate(10);
        return view('keeps.index', compact('keeps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('keeps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Keep::create($request->all());

        return redirect()->route('keeps.index')->with('success', 'Keep created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keep $keep)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keep $keep)
    {
        //$keep = Keep::findOrFail($id);
        return view('keeps.edit', compact('keep'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keep $keep)
    {
                $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //$keep = Keep::findOrFail($id);
        $keep->update($request->all());

        return redirect()->route('keeps.index')->with('success', 'Keep updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keep $keep)
    {
        //$keep = Keep::findOrFail($id);
        $keep->delete();
        return redirect()->route('keeps.index')->with('success', 'Moved to trash.');
    }

    public function trash()
    {
        $keeps = Keep::onlyTrashed()->paginate(10);
        return view('keeps.trash', compact('keeps'));
    }

    // Restore
    public function restore($id)
    {
        Keep::onlyTrashed()->find($id)->restore();
        return redirect()->route('keeps.trash')->with('success', 'Restored successfully.');
    }

    // Force delete
    public function forceDelete($id)
    {
        Keep::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('keeps.trash')->with('success', 'Deleted permanently.');
    }

    // Import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new KeepsImport, $request->file('file'));

        return back()->with('success', 'Imported successfully!');
    }

    // Export
    public function export()
    {
        return Excel::download(new KeepsExport, 'keeps.xlsx');
    }
}


