<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tasks\TaskStoreRequest;
use App\Http\Requests\Admin\Tasks\TaskUpdateRequest;
use App\Services\Tasks\TaskServiceInterface;
use App\Services\Wallets\WalletServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;
    private WalletServiceInterface $walletService;

    public function __construct(TaskServiceInterface $taskService, WalletServiceInterface $walletService)
    {
        $this->taskService = $taskService;
        $this->walletService = $walletService;
    }

    /**
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $tasks = $this->taskService->getAllPaginated();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        $types = TaskTypeEnum::cases();
        $statuses = TaskStatusEnum::cases();
        $wallets = $this->walletService->getAllWallets();

        return view('admin.tasks.create', compact('types', 'statuses', 'wallets'));
    }

    /**
     * @param TaskStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TaskStoreRequest $request)
    {
        $dto = TaskDTO::from($request);
        $this->taskService->create($dto);

        return redirect()->route('admin.tasks.index')->with('success', 'Görev başarıyla oluşturuldu.');
    }

    public function edit(int $id)
    {
        $task = $this->taskService->findById($id);
        $types = TaskTypeEnum::cases();
        $statuses = TaskStatusEnum::cases();
        $wallets = $this->walletService->getAllWallets();

        return view('admin.tasks.edit', compact('task', 'types', 'statuses', 'wallets'));
    }

    /**
     * @param TaskUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TaskUpdateRequest $request, int $id)
    {
        $dto = TaskDTO::from($request);
        $this->taskService->update($id, $dto);

        return redirect()->back()
            ->with('status', 'success')
            ->with('alert', 'Görev güncellendi.');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->taskService->delete($id);

        return redirect()->route('admin.tasks.index')
            ->with('status', 'success')
            ->with('alert', 'Görev silindi.');
    }

    /**
     * @param int $id
     * @param int $active
     * @return RedirectResponse
     */
    public function active(int $id, int $active): RedirectResponse
    {
        $dto = new TaskDTO();
        $dto->active = $active;
        $this->taskService->updateTaskActive($id, $dto);

        return redirect()->back()->with('status', 'success')
            ->with('status', 'success')
            ->with('alert', 'Durum güncellendi.');
    }
}
