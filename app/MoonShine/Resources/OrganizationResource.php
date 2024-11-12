<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;

use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use Throwable;

/**
 * @extends ModelResource<Organization>
 */
class OrganizationResource extends ModelResource
{
    protected string $model = Organization::class;

    protected string $title = 'Organizations';

    /**
     * @return list<MoonShineComponent|Field>
     * @throws Throwable
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Session', 'session', resource: new SessionsResource())->nullable(),
                Image::make('Logo', 'logo')
                    ->disk('organization_logo'),
                Text::make('Name', 'name'),
                Text::make('Type', 'type'),
                Text::make('Status', 'status'),
                TinyMce::make('Description', 'description')
                    ->hideOnIndex(),
                Image::make('Images', 'images')
                    ->disk('organization_images')
                    ->removable()
                    ->multiple(),
                Json::make('Parameters', 'parameters')
                    ->keyValue()
                    ->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @param Organization $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
