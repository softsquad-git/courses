<?php

namespace App\Http\Controllers\Admin\Payments\Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscriptions\SubscriptionRequest;
use App\Http\Resources\Payments\SubscriptionsResource;
use App\Models\Subscriptions\Subscription;
use App\Repositories\Payments\Subscriptions\SubscriptionRepository;
use App\Services\Payments\Subscriptions\SubscriptionService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    /**
     * @param SubscriptionRepository $subscriptionRepository
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(
        private SubscriptionRepository $subscriptionRepository,
        private SubscriptionService $subscriptionService
    )
    {
    }

    /**
     * @return Application|View|Factory
     */
    public function all(): Application|View|Factory
    {
        $data = $this->subscriptionRepository->findAll();

        return \view('admin.payments.subscriptions.index', [
            'data' => $data,
            'title' => 'Abonamenty'
        ]);
    }

    /**
     * @param SubscriptionRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(SubscriptionRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->subscriptionService->save($request->all());

            return redirect()->route('admin.subscriptions');
        }

        return \view('admin.payments.subscriptions.form', [
            'title' => 'Dodaj abonament',
            'item' => new Subscription()
        ]);
    }

    /**
     * @param SubscriptionRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(SubscriptionRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->subscriptionRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->subscriptionService->update($request->all(), $item);

            return redirect()->route('admin.subscriptions');
        }

        return \view('admin.payments.subscriptions.form', [
            'title' => 'Zmień abonament',
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->subscriptionRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->subscriptionService->remove($item);

        return redirect()->back();
    }
}
