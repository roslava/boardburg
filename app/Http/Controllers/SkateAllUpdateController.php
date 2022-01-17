<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use App\Models\User;

//use Illuminate\Http\Request;
//use App\Http\Controllers\SkateFromDbController;

class SkateAllUpdateController extends Controller
{

// 1. Получаю json c сервера, записываю в переменную $skatesFromServer_all
// 2. С помощью foreach перебираю массивы в массиве $skatesFromServer_all. На каждой итерации обращаюсь к $skatesFromBase для поиска...  как needle использую $skateFromServer['id]

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateAll()
    {

        $skatesFromServer = new SkateFromServerController();
        $skatesFromServer_all = $skatesFromServer->index();
        $count_created = 0;
        $count_updated = 0;
//2 $skatesFromServer_all перебираю циклом
        foreach ($skatesFromServer_all as $skateFromServer) {
//$current_id — это ID элемента $skateFromServer, попавшего в текущую итерацию
            $current_id = $skateFromServer['id'];
// echo '<h3>Искомый элемент массива с сервера — ID: ' . $current_id . '</h3><br>';
//проверяю существует ли (в колонке external_id) $skatesFromBase элемент с iD равным $current_id
            $current = Skate::where('external_id', '=', $current_id)->first();
//если элемент с ID равным $current_id в базе существует, то обновляю его, если нет создаю в базе новую запись
            if ($current === null) {
// echo "Нет! Добавить. По идее тут метод Store?!";
                $skatesFromServer->store($skateFromServer);
                $count_created++;
            } else {
// $result = "Есть! Обновить. По идее тут метод Update?!";
// echo $result . '<br>';
// Неужели при аптейте надо создавать новый объект целой базы??
                $skatesFromServer->update($skateFromServer, $current_id);
                $count_updated++;
            }
        }
        return redirect('http://boardburg.xx/skates-from-base')->with('success', 'Добавлено: ' . $count_created . ' | Обновлено: ' . $count_updated);
    }
}
