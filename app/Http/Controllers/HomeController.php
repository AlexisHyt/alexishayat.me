<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @throws Exception
     */
    public function index(): View
    {
        $projects = file_get_contents(public_path('projects_built.json'), true) ?? [];

        $technos = file_get_contents(public_path('technos.json'), true);

        return view('home', [
            'projects' => $projects,
            'technos' => $technos,
            'firstItemId' => array_key_first((array)json_decode($technos)->logos),
        ]);
    }
}
