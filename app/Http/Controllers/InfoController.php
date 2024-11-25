<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        $infos = Info::all();
        return view('admin.infos.index', compact('infos'));
    }

    public function userIndex()
    {
        $infos = Info::all();
        return view('infos.index', compact('infos'));
    }

    public function show(Info $info)
{
    return view('infos.show', compact('info'));
}


    public function create()
    {
        return view('admin.infos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',  
        'content' => 'required|string'        
    ]);

    Info::create($request->all());

    return redirect()->route('infos.index')->with('success', 'Info posted successfully');
}


    public function edit(Info $info)
    {
        return view('admin.infos.edit', compact('info'));
    }

    public function update(Request $request, Info $info)
    {
        $info->update($request->all());
        return redirect()->route('infos.index')->with('success', 'Info updated successfully');
    }

    public function destroy(Info $info)
    {
        $info->delete();
        return redirect()->route('infos.index')->with('success', 'Info deleted successfully');
    }
}
