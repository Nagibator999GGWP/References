<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body class="dark">
    <div class="w-screen h-full flex justify-center items-center">
        <form action="/request/create" method="POST" class="h-max w-max max-w-2/3 flex justify-between flex-col bg-accent p-6 px-8 gap-1.5">
            @csrf
            <h1 class="w-full text-center text-xl">Заполните бланк</h1> 
            @foreach ($query as $q)
                <div>
                    <label for={{$q['name']}}>{{$q['title']}}</label>
                    @if ($q['type'] == 'select')
                        <{{$q['type']}} required id={{$q['name']}} name={{$q['title']}}>
                    @foreach ($q['options'] as $option)
                        <option value={{$option}}>{{$option}}</option>
                    @endforeach
                    </{{$q['type']}}>
                    @elseif ($q['type'] == 'input')
                        <{{$q['type']}} required type={{$q['variant']}} id={{$q['name']}} name={{$q['title']}}/>
                    @endif
                </div>
            @endforeach
            <input name="nameQuery" hidden value={{$name}} />
            <button type="submit" class="mt-2">Подать заявку</button>
        </form>
    </div>
</body>
</html>