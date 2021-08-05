<?php

namespace App\Http\Controllers\Admin\Testimonials;

use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonials\TestimonialRequest;
use App\Http\Resources\Testimonials\TestimonialResource;
use App\Models\Testimonials\Testimonial;
use App\Repositories\Testimonials\TestimonialRepository;
use App\Services\Testimonials\TestimonialService;
use Illuminate\Http\JsonResponse;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * @param TestimonialRepository $testimonialRepository
     * @param TestimonialService $testimonialService
     */
    public function __construct(
        private TestimonialRepository $testimonialRepository,
        private TestimonialService $testimonialService
    )
    {}

    /**
     * @return Application|Factory|View
     */
    public function all(): Application|Factory|View
    {
        $data = $this->testimonialRepository->findAll();

        return view('admin.testimonials.index', [
            'data' => $data,
            'title' => 'Lista opini'
        ]);
    }

    /**
     * @param TestimonialRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(TestimonialRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->testimonialService->save($request->all());

            return redirect()->route('admin.testimonials');
        }

        return \view('admin.testimonials.form', [
            'item' => new Testimonial(),
            'title' => 'Dodaj opinię'
        ]);
    }

    /**
     * @param TestimonialRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(TestimonialRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->testimonialRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        if ($request->isMethod('POST')) {
            $this->testimonialService->update($request->all(), $item);

            return redirect()->route('admin.testimonials');
        }

        return \view('admin.testimonials.form', [
            'item' => $item,
            'title' => 'Zmień opinię'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->testimonialRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }
        $this->testimonialService->remove($item);

        return redirect()->back();
    }
}
