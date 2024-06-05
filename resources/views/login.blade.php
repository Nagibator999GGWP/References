<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
    @vite('resources/css/app.css')
</head>
<body class="dark">
    <div class='h-screen w-screen flex justify-center items-center'>
        <div class='bg-accent w-1/4 h-max'>
            <form class="flex flex-col justify-between p-6 h-full w-full gap-2" method="POST" action="/login">
                @csrf
                    <div>
                        <label for="email">Email</label>
                        <input placeholder="Введите email" type="email" name="email">
                    </div>
                    <div>
                        <label for="password">Пароль</label>
                        <input placeholder="Введите пароль" type="password" name="password">
                    </div>

                        <button class="mt-2">Войти</button>
                        <a href="register">Если у вас нет аккаунта, зарегистрируйтесь</a>
                        <div class="alert alert-danger">         
                            <ul>
                                <div class="text-red-500">{{ $errors->first() }}</li>
                            </ul>     
                        </div> 
                </form>
                @if ($errors->any())     

        </div>
    </div>

@endif
</body>
</html>