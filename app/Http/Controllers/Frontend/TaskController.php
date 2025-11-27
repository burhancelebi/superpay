<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Tasks\TaskServiceInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskServiceInterface $taskService) {}

    public function index(Request $request)
    {
        $tasks = $this->taskService->getActiveTasks();

        return view('frontend.tasks.index', compact('tasks'));
    }

    public function show(int $id)
    {
        $task = $this->taskService->findById($id);

        return view('frontend.tasks.detail', compact('task'));
    }
}
