<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Tasks\TaskServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private TaskServiceInterface $taskService)
    {
    }

    public function index(): Factory|View
    {
        $tasks = $this->taskService->getActiveTasks(8);

        return view('frontend.index', compact('tasks'));
    }
}
