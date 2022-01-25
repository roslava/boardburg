<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@if($details['role'] =='manager') <h1> Менеджер прислал сообщение</h1> @endif
@if($details['role'] =='guest') <h1> Посетитель сайта прислал сообщение</h1> @endif
<small>Имя отправитля: {{$details['name']}}</small><br>
<small>Отношение к сайту: {{$details['role']}}</small><br>
<small>Обратный адрес: {{$details['email']}}</small>
<hr>
<p>Сообщение: {{$details['message']}}</p>
</body>
</html>
