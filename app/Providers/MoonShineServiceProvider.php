<?php

namespace App\Providers;

use App\MoonShine\Resources\AlignmentResource;
use App\MoonShine\Resources\CharacteristicsResource;
use App\MoonShine\Resources\CharactersExperienceResource;
use App\MoonShine\Resources\DimensionsResource;
use App\MoonShine\Resources\ExperienceResource;
use App\MoonShine\Resources\CharactersResource;
use App\MoonShine\Resources\GendersResource;
use App\MoonShine\Resources\ModifierResource;
use App\MoonShine\Resources\ClassesResource;
use App\MoonShine\Resources\RaceResource;
use App\MoonShine\Resources\SkillsResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable()->icon('heroicons.cog-6-tooth'),

            MenuGroup::make('Константы', [
                MenuItem::make('Опыт', new ExperienceResource())
                    ->icon('heroicons.chevron-double-up'),
                MenuItem::make('Модификатор', new ModifierResource())
                    ->icon('heroicons.squares-2x2'),
                MenuItem::make('Размер существ', new DimensionsResource())
                    ->icon('heroicons.arrow-up-circle'),
            ])->icon('heroicons.wrench-screwdriver'),
            MenuGroup::make('Параметры существ', [
                MenuItem::make('Гендер', new GendersResource())
                    ->icon('heroicons.users'),
                MenuItem::make('Мировоззрение', new AlignmentResource())
                    ->icon('heroicons.scale'),
                MenuItem::make('Характеристики', new CharacteristicsResource())
                    ->icon('heroicons.star'),
                MenuItem::make('Навыки', new SkillsResource())
                    ->icon('heroicons.book-open'),
                MenuItem::make('Классы', new ClassesResource())
                    ->icon('heroicons.squares-2x2'),
                MenuItem::make('Расы', new RaceResource())
                    ->icon('heroicons.user-circle'),
            ])->icon('heroicons.chart-bar'),
            MenuGroup::make('Взаимодействие с персонажами', [
                MenuItem::make('Изменения опыта', new CharactersExperienceResource())
                    ->icon('heroicons.chart-bar'),
            ])->icon('heroicons.chart-pie'),
            MenuItem::make('Персонажи', new CharactersResource())
                ->icon('heroicons.user-circle'),
        ]);
    }
}
