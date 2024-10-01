<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scamer;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Date;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Scamer>
 */
class ScamerResource extends ModelResource
{
    protected string $model = Scamer::class;

    protected string $title = 'Скамеры';

    protected array $with = ['scamer_passes'];

    public function indexFields(): array
    {
        return [
            ID::make(),
            Text::make('ФИО', 'firstname',
                fn($item) => "$item->lastname $item->firstname $item->secondname")
                ->sortable(),
            Textarea::make('Описание', 'description',
                fn($item) => !is_null($item->description) ? strlen($item->description) > 40 ? mb_substr($item->description, 0, 40) . "..." : $item->description : "")
                ->nullable(),
            HasMany::make('Фото', 'scamer_photos', resource: new ScamerPhotoResource()),
        ];
    }

    public function detailFields(): array
    {
//        return [
//            Grid::make([
//                Column::make([
//                        Text::make('Имя', 'firstname')
//                            ->unescape()
//                            ->required(false)
//                            ->sortable(),
//                        Text::make('Фамилия', 'lastname')
//                            ->unescape()
//                            ->required(false)
//                            ->sortable(),
//                        Text::make('Отчество', 'secondname')
//                            ->unescape()
//                            ->required(false)
//                            ->sortable(),
//                        Textarea::make('Описание', 'description')
//                            ->unescape()
//                            ->required(false),
//                        Checkbox::make('Видимость', 'visible')
//                            ->default(true)
//                            ->required(true),
//                ])->columnSpan(8),
//
//                Column::make([
//                    HasMany::make('Фото', 'scamer_photos', resource: new ScamerPhotoResource()),
//                    HasMany::make('Паспорта', 'scamer_passes', resource: new ScamerPassResource()),
//                    HasMany::make('Телефонные номера', 'scamer_phones', resource: new ScamerPhoneResource()),
//                    HasMany::make('Профили в соц сетях', 'scamer_profiles', resource: new ScamerProfileResource()),
//                    HasMany::make('Другие имена', 'scamer_names', resource: new ScamerNameResource()),
//                    HasMany::make(
//                        'История скама',
//                        'scamer_scam_operations',
//                        resource: new ScamerScamOperationResource()
//                    )
//                ])->columnSpan(4)
//            ]),
//        ];
        return [
            Flex::make([
                    Text::make('Имя', 'firstname')
                        ->unescape()
                        ->required(false)
                        ->sortable(),
                    Text::make('Фамилия', 'lastname')
                        ->unescape()
                        ->required(false)
                        ->sortable(),
                    Text::make('Отчество', 'secondname')
                        ->unescape()
                        ->required(false)
                        ->sortable(),
                    Textarea::make('Описание', 'description')
                        ->unescape()
                        ->required(false),
                    Checkbox::make('Видимость', 'visible')
                        ->default(true)
                        ->required(true),


                    HasMany::make('Фото', 'scamer_photos', resource: new ScamerPhotoResource()),
                    HasMany::make('Паспорта', 'scamer_passes', resource: new ScamerPassResource()),
                    HasMany::make('Телефонные номера', 'scamer_phones', resource: new ScamerPhoneResource()),
                    HasMany::make('Профили в соц сетях', 'scamer_profiles', resource: new ScamerProfileResource()),
                    HasMany::make('Другие имена', 'scamer_names', resource: new ScamerNameResource()),
                    HasMany::make(
                        'История скама',
                        'scamer_scam_operations',
                        resource: new ScamerScamOperationResource()
                    )
            ]),
        ];
    }

    public function formFields(): array
    {
        return [
            Block::make([
//                ID::make()->sortable(),
                Text::make('Имя', 'firstname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Text::make('Фамилия', 'lastname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Text::make('Отчество', 'secondname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Textarea::make('Описание', 'description')
                    ->unescape()
                    ->required(false),
                Checkbox::make('Видимость', 'visible')
                    ->default(true)
                    ->required(true),
            ]),

            HasMany::make('Другие имена', 'scamer_passes', resource: new ScamerPassResource())
                ->creatable()
                ->fields([
                    Text::make('Серия', 'pass_serial'),
                    Text::make('Номер', 'pass_number'),
                    Checkbox::make('Настоящий', 'is_real'),
                    Image::make('Фото', 'photo_path')
                        ->dir('/')
                        ->disk('public')
//                        ->allowedExtensions(['jpg', 'png'])
//                            ->required()
//                        ->removable()
//                        ->customName(fn(UploadedFile $file) =>  "images" . Carbon::now()->format('Ym') . '/' . $file->hashName()),
                ])->creatable(),

            HasMany::make('Паспорта', 'scamer_names', resource: new ScamerNameResource())
                ->creatable()
                ->fields([
                    Text::make('Фамилия', 'lastname')->unescape(),
                    Text::make('Имя', 'firstname')->unescape(),
                    Text::make('Отчество', 'secondname')->unescape()
                ])->creatable()
        ];
    }
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
//                ID::make()->sortable(),
                Text::make('Имя', 'firstname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Text::make('Фамилия', 'lastname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Text::make('Отчество', 'secondname')
                    ->unescape()
                    ->required(false)
                    ->sortable(),
                Textarea::make('Описание', 'description')
                    ->unescape()
                    ->required(false),
                Checkbox::make('Видимость', 'visible')
                    ->default(true)
                    ->required(true),
            ]),

            HasMany::make('Другие имена', 'scamer_passes', resource: new ScamerPassResource())
//                ->creatable()
                ->fields([
                    Text::make('Серия', 'pass_serial'),
                    Text::make('Номер', 'pass_number'),
                    Checkbox::make('Настоящий', 'is_real'),
                    Image::make('Фото', 'photo_path')
                        ->dir('/')
                        ->disk('public')
//                        ->allowedExtensions(['jpg', 'png'])
//                            ->required()
//                        ->removable()
//                        ->customName(fn(UploadedFile $file) =>  "images" . Carbon::now()->format('Ym') . '/' . $file->hashName()),
            ])->creatable(),

            HasMany::make('Паспорта', 'scamer_names', resource: new ScamerNameResource())
//                ->creatable()
                ->fields([
                    Text::make('Фамилия', 'lastname')->unescape(),
                    Text::make('Имя', 'firstname')->unescape(),
                    Text::make('Отчество', 'secondname')->unescape()
                ])
        ];
    }

    /**
     * @param Scamer $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
