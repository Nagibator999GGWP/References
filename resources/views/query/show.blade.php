<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$query['name']}}</title>
    @vite('resources/css/app.css')
</head>
<body class="dark">
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-max h-max flex bg-accent flex-col p-6">
            @foreach($query['data'] as $k => $d)
            <div>

                @if ($k != '_token' || $k != 'nameQuery')
                {{$k}} - {{$d}}
                @endif
            </div>
            @endforeach
            @if (auth()->user()->role == 'secretary')
            <form action="/query/status" method="POST" class="h-8 w-full mt-2">
                @csrf
                <input hidden value={{$query['id']}} name="query_id"/>
                <button  class="h-full">Подтвердить </button>
                <select class="h-full" name="status" name="" id="">
                    <option value="Завершено">Завершение</option>    
                    <option value="Откланено">Отклонение</option>  
                    <option value="В ожидании">Ожидание</option>    

                </select>
            </form>
        @endif
        </div>
    </div>
</body>
</html>