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
<form action="{{route('skates_base.cat')}}" method="GET">


    <div class="custom-control custom-radio">
        <input type="radio" id="customRadio1" value="1"  name="cat" class="custom-control-input">
        <label class="custom-control-label" for="customRadio1">Деки</label>
    </div>


    <div class="custom-control custom-radio">
        <input type="radio" id="customRadio2" value="2"  name="cat" class="custom-control-input">
        <label class="custom-control-label" for="customRadio2">Подвески</label>
    </div>


    <div class="custom-control custom-radio">
        <input type="radio" id="customRadio3"  value="3"   name="cat" class="custom-control-input">
        <label class="custom-control-label" for="customRadio3">Колеса</label>
    </div>


    <div class="custom-control custom-radio">
        <input type="radio" id="customRadio4"  value="4"   name="cat" class="custom-control-input">
        <label class="custom-control-label" for="customRadio4">Подшипники</label>
    </div>


    <input type="submit" value="проверить">
</form>

</body>
</html>

