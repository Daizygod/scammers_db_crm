<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

{{--        <!-- Fonts -->--}}
{{--        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >--}}
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>

        <style>
            body {
                margin: 0;
                font-family: "Verdana", Sans-serif;
            }

            .main-container {

            }

            .scam-table {
                width: 100%;
            }

            .scamer-item {
                height: 3em;
            }

            .scamer-item-name {
                text-align: center;
            }
        </style>
    </head>
    <body class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
<div class="main-container bg-white border-b dark:bg-gray-800 dark:border-gray-700 p-8">
{{--    <div class="search-fields">--}}
{{--        <form action="{{ route('index') }}" method="GET">--}}
{{--            <label for="lastname">Фамилия</label>--}}
{{--            <input id="lastname" type="text" name="lastname" placeholder="" value="{!! app('request')->get('lastname') !!}"/>--}}

{{--            <label for="firstname">Имя</label>--}}
{{--            <input id="firstname" type="text" name="firstname" placeholder="" value="{!! app('request')->get('firstname') !!}"/>--}}

{{--            <label for="secondname">Отчество</label>--}}
{{--            <input id="secondname" type="text" name="secondname" placeholder="" value="{!! app('request')->get('secondname') !!}"/>--}}

{{--            <button type="submit">Поиск</button>--}}
{{--        </form>--}}
{{--    </div>--}}
    <form action="{{ route('index') }}" method="GET">
        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            ФИО
        </p>
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="lastname"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                <input type="text" id="lastname" name="lastname"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Иванов"
                       value="{!! app('request')->get('lastname') !!}"/>
            </div>
            <div>
                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                <input type="text" id="firstname" name="firstname"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Иван"
                       value="{!! app('request')->get('firstname') !!}"/>
            </div>
            <div>
                <label for="secondname"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                <input type="text" id="secondname" name="secondname"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Иванович"
                       value="{!! app('request')->get('secondname') !!}"/>
            </div>
        </div>
        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Паспорт
        </p>
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="pass_serial"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Серия</label>
                <input type="text" id="pass_serial" name="pass_serial"
                        inputmode="numeric"
                       maxlength="4"
                       minlength="4"
                        pattern="[0-9\s]{4}"
                       placeholder="xxxx"



                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                       value="{!! app('request')->get('pass_serial') !!}"/>
            </div>
            <div>
                <label for="pass_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номер</label>
                <input type="text" id="pass_num" name="pass_num"
                       inputmode="numeric"
                       maxlength="6"
                       minlength="6"
                       pattern="[0-9\s]{6}"
                       placeholder="xxxxxx"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                       value="{!! app('request')->get('pass_num') !!}"/>
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="phone"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Телефон, формат - 79171234567</label>
                <input type="tel" id="phone" name="phone"
                       inputmode="numeric"
                       maxlength="11"
                       minlength="11"
                       pattern="7[0-9\s]{10}"
                       placeholder="79171234567"



                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                       value="{!! app('request')->get('phone') !!}"/>
            </div>
        </div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Поиск
        </button>
    </form>
{{--    @php--}}
{{--        dd(app('request')->get('firstname'));--}}
{{--    @endphp--}}
{{--    @if( request()->get('firstname') )--}}
{{--        <script>console.log('hello')</script>--}}
{{--    @endif--}}


    <div class="relative overflow-x-auto mt-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ФИО
                </th>
                <th scope="col" class="px-6 py-3">
                    Паспорт
                </th>
                <th scope="col" class="px-6 py-3">
                    Телефон
                </th>
                <th scope="col" class="px-6 py-3">
                    Соцсети
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach ($scammers as $scammer)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$scammer->lastname . " " . $scammer->firstname . " " . $scammer->secondname}}
                        @if($scammer->scamer_photos)

                            @foreach($scammer->scamer_photos as $photo)
                                <a href="{{env('APP_URL') . "/storage/" . $photo->photo_path}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">фото</a>
                            @endforeach
                        @endif
                    </th>
                    <td class="px-6 py-4">
                    @if($scammer->scamer_passes)
                        @foreach($scammer->scamer_passes as $pass)
                                {{$pass->pass_serial . " " . $pass->pass_number}} <a href="{{env('APP_URL') . "/storage/" . $pass->photo_path}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">фото</a> <br>
                        @endforeach
                    @else

                    @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($scammer->scamer_phones)
                            @foreach($scammer->scamer_phones as $phone)
                                {{$phone->phone}} <br>
                            @endforeach
                        @else

                        @endif
                    </td>

                    <td class="px-6 py-4">
                        @if($scammer->scamer_profiles)
                            @foreach($scammer->scamer_profiles as $profile)
                                <a href="{{$profile->url}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    {{ $profile->type }}
                                </a>
                            @endforeach
                        @else

                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
{{--    {{ $scammers->links() }}--}}

</div>
    </body>
</html>
