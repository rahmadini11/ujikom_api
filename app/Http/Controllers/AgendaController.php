<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('admin.agendas.index', compact('agendas'));
    }

    public function userIndex()
    {
        $agendas = Agenda::all();
        return view('agendas.index', compact('agendas'));
    }

    public function show($id)
{
    $agenda = Agenda::findOrFail($id);
    return view('agendas.show', compact('agenda'));
}


    public function create()
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'nullable|date',
        ]);

        Agenda::create($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda created successfully.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'nullable|date',
        ]);

        $agenda->update($validated);

        return redirect()->route('agendas.index')->with('success', 'Agenda updated successfully.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'Agenda deleted successfully.');
    }
}
