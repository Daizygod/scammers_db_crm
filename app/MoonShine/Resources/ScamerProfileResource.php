<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\ProfileTypeEmun;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScamerProfile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Url;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ScamerProfile>
 */
class ScamerProfileResource extends ModelResource
{
    protected string $model = ScamerProfile::class;

    protected string $title = 'Профили в соц сетях';

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
                Enum::make('Соц сеть', 'type')
                    ->attach(ProfileTypeEmun::class),
//                Enum::make('Ссылка', 'url')
//                    ->attach(ProfileTypeEmun::class)
                Text::make('Ссылка', 'url',
//                    fn($item) => $item->type == ProfileTypeEmun::AVITO ?
//                        parse_url($item->url, PHP_URL_SCHEME) . '://' . parse_url($item->url, PHP_URL_HOST) . parse_url($item->url, PHP_URL_PATH)
//                        : $item->url
                )->unescape()
            ]),
        ];
    }

    /**
     * @param ScamerProfile $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    protected function afterCreated(Model $item): Model
    {
        if ($item->type === ProfileTypeEmun::avito->name) {
            $item->url = parse_url($item->url, PHP_URL_SCHEME)
                . '://'
                . parse_url($item->url, PHP_URL_HOST)
                . parse_url($item->url, PHP_URL_PATH);
            $item->save();
        }

        return $item;
    }

    protected function beforeUpdating(Model $item): Model
    {
        if (request()->get('type') !== $item->type) {
            if (request()->get('type') === ProfileTypeEmun::avito->name) {

                $newUrl = parse_url($item->url, PHP_URL_SCHEME)
                    . '://'
                    . parse_url($item->url, PHP_URL_HOST)
                    . parse_url($item->url, PHP_URL_PATH);

                request()->merge([
                    'url' => $newUrl,
                ]);
//                $item->url = parse_url($item->url, PHP_URL_SCHEME)
//                    . '://'
//                    . parse_url($item->url, PHP_URL_HOST)
//                    . parse_url($item->url, PHP_URL_PATH);
            }
        } elseif ($item->type === ProfileTypeEmun::avito->name && request()->get('url') !== $item->url) {

            $newUrl = parse_url($item->url, PHP_URL_SCHEME)
                . '://'
                . parse_url($item->url, PHP_URL_HOST)
                . parse_url($item->url, PHP_URL_PATH);

            request()->merge([
                'url' => $newUrl,
            ]);
        }

        return $item;
    }
}
