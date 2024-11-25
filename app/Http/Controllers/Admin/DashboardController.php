<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Info;
use App\Models\Agenda;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah total data
        $userCount = User::where('role', 'user')->count();
        $galleryCount = Gallery::count();
        $infoCount = Info::count();
        $agendaCount = Agenda::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('userCount', 'galleryCount', 'infoCount','agendaCount'));
    }
}