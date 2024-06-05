<?php

declare(strict_types=1);

namespace App\Orchid;

use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Секретарь')
                ->icon('bs.book')
                ->title('Секретарь')
                ->route('platform.secr')
                ->canSee(Auth::user()->inRole('admin')),

                Menu::make('Все справки')
                ->icon('bs.book')
                ->title('Студент')
                ->route('platform.student')
                ->canSee(!Auth::user()->inRole('admin')),


                Menu::make('Готовые справки')
                ->icon('bs.book')
                ->route('platform.ready')
                ->canSee(!Auth::user()->inRole('admin')),
                Menu::make('Обучение')
                ->icon('bs.book')
                ->title('Заказать справку')
                ->route('platform.styde')
                ->canSee(!Auth::user()->inRole('admin')),
                Menu::make('Стипендия')
                ->icon('bs.book')
                ->route('platform.stipendia')
                ->canSee(!Auth::user()->inRole('admin')),
            // Menu::make(__('Секретарь'))
            //     ->icon('bs.book')
            //     ->title('Секретарь')
            //     ->route(config('platform.secretary')),



            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),


        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
