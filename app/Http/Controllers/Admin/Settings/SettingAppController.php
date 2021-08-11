<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\BasicDataSettingRequest;
use App\Http\Requests\Settings\SettingAppRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Models\Users\User;
use App\Repositories\Settings\SettingAppRepository;
use App\Repositories\Users\UserRepository;
use App\Services\Settings\SettingAppService;
use App\Services\Users\UserSettingsService;
use \Exception;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class SettingAppController extends Controller
{
    /**
     * @param SettingAppService $settingAppService
     * @param SettingAppRepository $settingAppRepository
     * @param UserSettingsService $userSettingsService
     * @param UserRepository $userRepository
     */
    public function __construct(
        private SettingAppService $settingAppService,
        private SettingAppRepository $settingAppRepository,
        private UserSettingsService $userSettingsService,
        private UserRepository $userRepository
    )
    { }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('admin.settings.index', [
            'title' => 'Ustawienia'
        ]);
    }

    /**
     * @param SettingAppRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function application(SettingAppRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $item = $this->settingAppRepository->findOneBy([
                'name' => $data['name']
            ]);

            if (!$item) {
                return redirect()->back()
                    ->with('notification.error', 'Wpis ustawień nie istnieje');
            }

            $this->settingAppService->update($data, $item);

            return redirect()->back()
                ->with('notification.success', 'Dane zostały zapisane');
        }

        $settingsApp = $this->settingAppRepository->findAll();

        return view('admin.settings.app', [
            'title' => 'Ustawienia aplikacji',
            'settingsApp' => $settingsApp
        ]);
    }

    /**
     * @return Application|Factory|View
     * @throws Exception
     */
    public function account(): Application|Factory|View
    {
        $user = $this->userRepository->find(Auth::id());

        return view('admin.settings.account', [
            'title' => 'Ustawienia konta',
            'user' => $user
        ]);
    }

    /**
     * @param BasicDataSettingRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function changeBasicData(BasicDataSettingRequest $request): RedirectResponse
    {
        $data = $request->only([
            'name',
            'last_name',
            'first_name'
        ]);

        /**
         * @var User $user
         */
        $user = $this->userRepository->find(Auth::id());

        $this->userSettingsService->update($user, $data);

        return redirect()->back()
            ->with('notification.success', 'Dane zostały zapisane');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $data = $request->only(['old_password', 'new_password']);

        /**
         * @var User $user
         */
        $user = $this->userRepository->find(Auth::id());

        $this->userSettingsService->passwordUpdate($user, $data);

        return redirect()->back()
            ->with('notification.success', 'Dane zostały zapisane');
    }
}
