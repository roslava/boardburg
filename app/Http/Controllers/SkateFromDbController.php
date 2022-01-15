<?php

namespace App\Http\Controllers;
use App\Models\Skate;
use http\Env\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\LengthAwarePaginator;


class SkateFromDbController extends Controller


// 1. Получаю json c сервера, записываю в переменную $skatesFromServer_all

// 2. С помощью foreach перебираю массивы в массиве $skatesFromServer_all. На каждой итерации обращаюсь к $skatesFromBase для поиска...  как needle использую $skateFromServer['id]


{

    public function index()
    {
        $skatesFromBase = Skate::paginate(8);
        $quantity = count(Skate::all());
        return view('skates', compact('skatesFromBase', 'quantity'));
    }




    public function store($skateFromServer)
    {
        $skates = new Skate;
        $skates::create([
            'external_id' => $skateFromServer['id'],
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
            'user_id' => 0,
        ]);
    }


    public function show($id)
    {

        $skateFromBase = Skate::all()->where('id',$id)->first();

        return view('skate',['skateFromBase' => $skateFromBase, 'previous_url' => URL::previous()] );


    }


    public function edit($id)
    {

    }


    public function update($skateFromServer, $id)
    {
        Skate::where('external_id', $id)->update([
            'name' => $skateFromServer['name'],
            'description' => $skateFromServer['description'],
            'img' => $skateFromServer['img'],
            'price' => $skateFromServer['price'],
            'category_id' => $skateFromServer['category_id'],
        ]);
    }


    public function updateAll()
    {
////1

        $skatesFromServer = new SkateFromServerController();
        $skatesFromServer_all = $skatesFromServer->index();

        $count_created =0;
        $count_updated =0;

        //2 $skatesFromServer_all перебираю циклом
        foreach ($skatesFromServer_all as $skateFromServer) {

            //$current_id — это ID элемента $skateFromServer, попавшего в текущую итерацию
            $current_id = $skateFromServer['id'];

//            echo '<h3>Искомый элемент массива с сервера — ID: ' . $current_id . '</h3><br>';
//проверяю существует ли (в колонке external_id) $skatesFromBase элемент с iD равным $current_id
            $current = Skate::where('external_id', '=', $current_id)->first();

//если элемент с ID равным $current_id в базе существует, то обновляю его, если нет создаю в базе новую запись

            if ($current === null) {

//                echo "Нет! Добавить. По идее тут метод Store?!";
                $this->store($skateFromServer);
                $count_created ++;

            } else {

//                $result = "Есть! Обновить. По идее тут метод Udate?!";
//                echo $result . '<br>';
//                Неужели при аптейте надо создавать новый объект целой базы??
                $this->update($skateFromServer, $current_id);
                $count_updated ++;



            }

        }
//        $skates = new Skate;
//        return view('home', ['skatesFromBase' => $skates::paginate(8), 'count_created' => $count_created, 'count_updated' => $count_updated ]);
        return redirect('http://boardburg.xx/skates-from-base')->with('success', 'Добавлено: '.$count_created.' | Обновлено: '.$count_updated);

    }


    public function destroy($id)
    {
        $skateFromBase = Skate::all()->where('id',$id)->first();
        $skateFromBase->delete();
        return redirect('skates-from-base')->with('success', "Товар с ID $id был удален");


    }
}
