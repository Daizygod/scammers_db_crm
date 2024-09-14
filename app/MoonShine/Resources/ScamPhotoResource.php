<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScamPhoto;

use Illuminate\Http\UploadedFile;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ScamPhoto>
 */
class ScamPhotoResource extends ModelResource
{
    protected string $model = ScamPhoto::class;

    protected string $title = 'Фото скама';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                BelongsTo::make('Скам', 'scamer_scam_operation',
                    fn($item) => strlen($item->description) > 40 ? mb_substr($item->description, 0, 40) . "..." : $item->description,
                    resource: new ScamerScamOperationResource()),
//                    ->asyncSearch(
//                        'firstname',
//                        asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
//                            return $query->whereLike('firstname', '%' . $request->get('query') . '%')
//                                ->orWhereLike('lastname', '%' . $request->get('query') . '%')
//                                ->orWhereLike('secondname', '%' . $request->get('query') . '%');
//                        },
//                        replaceQuery: true
//                    )
//                    ->hideOnIndex(),

                Image::make('Фото', 'photo_path')
                    ->dir('/')
                    ->disk('public')
                    ->allowedExtensions(['jpg', 'png'])
                    ->customName(fn(UploadedFile $file) =>  "images" . Carbon::now()->format('Ym') . '/' . $file->hashName()),
            ]),
        ];
    }

    /**
     * @param ScamPhoto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
