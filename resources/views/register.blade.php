<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class='h-screen w-screen bg-gray-200 flex justify-center items-center'>
        <div class='bg w-1/4 h-max'>
            <form class="flex flex-col justify-between p-6 rounded-md h-full w-full gap-4 bg-white shadow-md" method="POST" action="/register">
                @csrf
                <h2 class="text-2xl font-bold">Зарегестрироваться</h2>
                    <div>
                        <label class="block font-bold text-xs" for="name">Имя</label>
                        <input placeholder="Введите ваше имя" class="border-[1px] p-1 text-sm focus:bg-gray-100 rounded-sm border-gray-500/40 w-full" id="name" type="text" name="name">
                    </div>
                    <div>
                        <label class="block font-bold text-xs" for="email">Email</label>
                        <input type="email" placeholder="Введите ваш Email" class="border-[1px] focus:bg-gray-100 p-1 text-sm rounded-sm border-gray-500/40 w-full" id="email" type="email" name="email">
                    </div>
                    <div>
                        <label class="block font-bold text-xs" for="password">Пароль</label>
                        <input type="password" placeholder="Введите ваш пароль" class="border-[1px] focus:bg-gray-100 p-1 text-sm rounded-sm border-gray-500/40 w-full" id="password" type="password" name="password">
                    </div>
                    <button class="border-[1px] hover:shadow-md border-gray-500/40 p-1 rounded-sm">Зарегестрироваться</button>
                </form>
        </div>
    </div>
</body>
</html>