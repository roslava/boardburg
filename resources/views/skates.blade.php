<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

{{--    <script src="https://cdn.tailwindcss.com"></script>--}}


    <title>Document</title>
</head>

    <div class="container">


        {{ $skatesFromBase->links('pagination::bootstrap-4')}}


        <table class="table table-sm table-dark table-hover">
            <thead  class="table-dark">
            <tr>
                <th>ID</th>
                <th>External ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Img</th>
                <th>Price</th>
                <th>Category id</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>functional</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skatesFromBase as $skateFromBase)
            <tr class="border border-gray-600">
                <td>{{$skateFromBase->id}}</td>
                <td>{{$skateFromBase->external_id}}</td>
                <td>{{$skateFromBase->name}}</td>
                <td>Количество знаков: {{ iconv_strlen($skateFromBase,'UTF-8')}} </td>
                <td><img class="" style="max-width: 200px; max-height: 200px; margin:5px;" src={{$skateFromBase->img}} alt=""></td>
                <td>{{$skateFromBase->price}}</td>
                <td>{{$skateFromBase->category_id}}</td>
                <td>{{$skateFromBase->created_at}}</td>
                <td>{{$skateFromBase->updated_at}}</td>
                <td>

                    <form action="{{ route('skates_base.destroy', $skateFromBase->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger" style="width:80px">Delete</button>
                    </form>

                    <form action="{{ route('skates_base.show', $skateFromBase->id)}}">
                        <button class="btn btn-info" style="width:80px">Show</button>
                    </form>

                </td>

            </tr>
            @endforeach

            </tbody>
        </table>
        <form action="/skates-from-base/update_all" method="get">
{{--            @csrf--}}
        <button class="btn btn-success" style="width:120px">Update All</button>
        </form>


        <a class="btn btn-warning" style="display: block; width:120px" href="{{route('skates_form.create')}}">Create New</a>




        Новых товаров: {{$count_created ?? '0'}} <br>
        Обновленных товаров: {{$count_updated ?? '0'}}

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
{{--        skates_server.create--}}



    </div>


    </body>
</html>
