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
        <div class='bg-accent w-max h-max max-w-1/3'>
            <form class="flex flex-col justify-between p-6 px-8 h-full w-full" method="POST" action="/request">
                @csrf
                <h2 class="text-xl mb-2">Выберите справку:</h2>
                    <ul class="text-balance">
                        <li>
                            <a href="/request/stipendia">Справка о размере стипендии</a>
                        </li>
                        <li>
                            <a href="/request/study">Cправка об обучении</a>
                        </li>
                    </ul>
                </form>
        </div>
    </div>

</body>
<script>
    const queryBody = document.querySelector('.query_body');
    const query = document.querySelector('.query');

    query.addEventListener('change', () => {
        queryBody.style.display = 'flex'
    })
</script>
</html>