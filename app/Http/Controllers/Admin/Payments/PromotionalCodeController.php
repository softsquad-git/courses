<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\PromotionalCodeRequest;
use App\Models\Payments\PromotionalCode;
use App\Repositories\Payments\PromotionalCodeRepository;
use App\Services\Payments\PromotionalCodeService;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PromotionalCodeController extends Controller
{
    /**
     * @param PromotionalCodeRepository $promotionalCodeRepository
     * @param PromotionalCodeService $promotionalCodeService
     */
    public function __construct(
        private PromotionalCodeRepository $promotionalCodeRepository,
        private PromotionalCodeService $promotionalCodeService
    )
    {}

    /**
     * @return Application|Factory|View
     */
    public function all(): Application|Factory|View
    {
        $data = $this->promotionalCodeRepository->findAll();

        return \view('admin.payments.discount-codes.index', [
            'data' => $data,
            'title' => 'Kody promocyjne'
        ]);
    }

    /**
     * @param PromotionalCodeRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(PromotionalCodeRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->promotionalCodeService->save($request->all());

            return redirect()->route('admin.discount_codes');
        }

        return \view('admin.payments.discount-codes.form', [
            'item' => new PromotionalCode(),
            'title' => 'Dodaj kod rabatowy'
        ]);
    }

    /**
     * @param PromotionalCodeRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(PromotionalCodeRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->promotionalCodeRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->promotionalCodeService->update($request->all(), $item);

            return redirect()->route('admin.discount_codes');
        }

        return \view('admin.payments.discount-codes.form', [
            'item' => $item,
            'title' => 'Edytuj kod promocyjny'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->promotionalCodeRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->promotionalCodeService->remove($item);

        return redirect()->back();
    }
}
