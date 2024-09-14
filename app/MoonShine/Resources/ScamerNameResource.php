<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\ScamerName;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ScamerName>
 */
class ScamerNameResource extends ModelResource
{
    protected string $model = ScamerName::class;

    protected string $title = 'Другие имена';

    /**
     * @return Field
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
                Text::make('Фамилия', 'lastname')->unescape(),
                Text::make('Имя', 'firstname')->unescape(),
                Text::make('Отчество', 'secondname')->unescape()
            ]),
        ];
    }

    /**
     * @param ScamerName $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
