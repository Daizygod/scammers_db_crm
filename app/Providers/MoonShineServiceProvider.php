<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Scamer;
use App\Models\ScamerName;
use App\Models\ScamerPass;
use App\Models\ScamerPhone;
use App\Models\ScamerPhoto;
use App\Models\ScamerProfile;
use App\Models\ScamerScamOperation;
use App\Models\ScamPhoto;
use App\MoonShine\Resources\ScamerNameResource;
use App\MoonShine\Resources\ScamerPassResource;
use App\MoonShine\Resources\ScamerPhoneResource;
use App\MoonShine\Resources\ScamerPhotoResource;
use App\MoonShine\Resources\ScamerProfileResource;
use App\MoonShine\Resources\ScamerResource;
use App\MoonShine\Resources\ScamerScamOperationResource;
use App\MoonShine\Resources\ScamPhotoResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
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
                    new MoonShineUserRoleResource()
                ),
            ]),

            MenuGroup::make('Мошенники', [
                MenuItem::make('Скамеры', new ScamerResource())
                    ->icon("heroicons.scale")
                    ->badge(fn() => Scamer::all()->count()),
                MenuItem::make('Паспорта', new ScamerPassResource())
                    ->icon("heroicons.identification")
                    ->badge(fn() => ScamerPass::all()->count()),
                MenuItem::make('Фото скамеров', new ScamerPhotoResource())
                    ->icon("heroicons.photo")
                    ->badge(fn() => ScamerPhoto::all()->count()),
                MenuItem::make('Другие имена', new ScamerNameResource())
                    ->icon("heroicons.tag")
                    ->badge(fn() => ScamerName::all()->count()),
                MenuItem::make('Номера телефонов', new ScamerPhoneResource())
                    ->icon("heroicons.phone")
                    ->badge(fn() => ScamerPhone::all()->count()),
                MenuItem::make('Профили в соц сетях', new ScamerProfileResource())
                    ->icon("heroicons.share")
                    ->badge(fn() => ScamerProfile::all()->count()),
                MenuItem::make('История скама', new ScamerScamOperationResource())
                    ->icon("heroicons.clock")
                    ->badge(fn() => ScamerScamOperation::all()->count()),
                MenuItem::make('Фото скама', new ScamPhotoResource())
                    ->icon("heroicons.viewfinder-circle")
                    ->badge(fn() => ScamPhoto::all()->count()),
            ])->icon("heroicons.hand-raised"),

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
