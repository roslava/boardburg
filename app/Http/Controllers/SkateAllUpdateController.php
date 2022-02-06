<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Support\Facades\Gate;


class SkateAllUpdateController extends Controller
{
    public function updateAll()
    {
        Gate::authorize('update-all');
        $skatesFromServer = new SkateFromServerController();
        $skates = $skatesFromServer->index();
        $count_created = 0;
        $count_updated = 0;
        foreach ($skates as $skate) {
            $current_id = $skate['id'];
            $current = Skate::where('external_id', '=', $current_id)->first();
            if ($current === null) {
                $skatesFromServer->store($skate);
                $count_created++;
            } else {
                $skatesFromServer->update($skate, $current_id);
                $count_updated++;
            }
        }
        return redirect('/skates')->with('success', 'Добавлено: ' . $count_created . ' | Обновлено: ' . $count_updated);
    }
}
