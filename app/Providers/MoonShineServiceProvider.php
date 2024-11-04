<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CharactersResource;
use App\MoonShine\Resources\InventoryResource;
use App\MoonShine\Resources\ItemResource;
use App\MoonShine\Resources\LocationResource;
use App\MoonShine\Resources\SessionsResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource(), 'heroicons.user-group'
                ),
            ]),
            MenuGroup::make('Game', [
                MenuItem::make(
                    static fn() => 'Sessions',
                    new SessionsResource(),
                ),
                MenuItem::make(
                    static fn() => 'Locations',
                    new LocationResource(),
                ),
                MenuItem::make(
                    static fn() => 'Items',
                    new ItemResource(),
                ),
            ]),
            MenuGroup::make('Characters', [
                MenuItem::make(
                    static fn() => 'Characters',
                    new CharactersResource(),
                ),
                MenuItem::make(
                    static fn() => 'Inventory',
                    new InventoryResource(),
                ),
            ]),

            MenuItem::make('Documentation', 'https://moonshine-laravel.com/docs')
                ->badge(fn() => 'Check')
                ->blank(),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
