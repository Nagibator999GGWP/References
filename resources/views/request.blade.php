<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Запросы</title>
    @vite('resources/css/app.css')

</head>
<body class="dark">
    <div class="relative py-12 flex flex-col items-center h-full w-full">
        <div class='text-2xl mb-2'>
            @if (auth()->user()->role == 'secretary')
                Все заявки
            @else
                Ваши заявки
            @endif
        </div>
        <div class="w-1/3 bg-background  flex flex-col gap-4">
            @foreach($requests as $q)
                <div class="bg-accent gap-4 p-4 px-6 w-full">
                        <div class="">ФИО: {{$q['data']['ФИО/']}}</div>
                        <div class="">Дата заявки: {{$q['updated_at']}}</div>
                        <div class="">
                            Заявление: {{$q['name']}} 
                        </div>
                        <div class="">
                            Статус: {{$q['status']}}
                        </div>
                        <button>

                            <a href="/query/{{$q['id']}}">Узнать подробнее</a>
                        </button>
                </div>
            @endforeach
        </div>
        <div class="group  absolute w-[68px] hover:bg-foreground transition-all p-4 h-[68px] flex justify-center items-center right-4 bottom-4 bg-accent rounded-[50%]">
            <a href="request" class="group-hover:text-background text-sm text-pretty ">Заказать </br> справку</a>
        </div>
        <div class="group  absolute w-[68px] hover:bg-foreground transition-all p-4 h-[68px] flex justify-center items-center left-4 bottom-4 bg-accent rounded-[50%]">
            <a href="logout" class="group-hover:text-background text-sm text-pretty ">Выйти</a>
        </div>
    </div>
</body>
</html>