<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScamerPhone;

use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ScamerPhone>
 */
class ScamerPhoneResource extends ModelResource
{
    protected string $model = ScamerPhone::class;

    protected string $title = 'Номера телефонов';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                BelongsTo::make('Скамер', 'scamer',
                    fn($item) => "$item->lastname $item->firstname $item->secondname",
                    resource: new ScamerResource())
                    ->asyncSearch(
                        'firstname',
                        asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                            return $query->whereLike('firstname', '%' . $request->get('query') . '%')
                                ->orWhereLike('lastname', '%' . $request->get('query') . '%')
                                ->orWhereLike('secondname', '%' . $request->get('query') . '%');
                        },
                        replaceQuery: true
                    )
                    ->hideOnIndex(),
                Text::make('Телефон', 'phone')->unescape(),
            ]),
        ];
    }

    /**
     * @param ScamerPhone $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
