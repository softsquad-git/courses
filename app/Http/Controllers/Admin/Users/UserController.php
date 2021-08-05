<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;
use \Exception;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        private UserRepository $userRepository
    )
    {}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function all(Request $request): Application|Factory|View
    {
        $data = $this->userRepository->findBy(
            $request->all(),
            $request->get('ordering', 'DESC'),
            $request->get('pagination', 20)
        );

        return view('admin.users.index', [
            'data' => $data,
            'title' => 'Lista użytkowników'
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function find(int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->userRepository->find($id);
        if (!$item) {
            return $this->noPage();
        }

        return view('admin.users.show', [
            'item' => $item,
            'title' => $item->name
        ]);
    }
}
