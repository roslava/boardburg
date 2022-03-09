<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Services\DataUpdater\DataUpdaterService;

class ProductsSyncController extends Controller
{
    public function updateAll(DataUpdaterService $data)
    {
        Gate::authorize('update-all');
        $skates = $data->index();

        $count_created = 0;
        $count_updated = 0;
        foreach ($skates as $skate) {
            $current_id = $skate['id'];
            $current = Product::where('external_id', '=', $current_id)->first();
            if ($current === null) {
                $data->store($skate);
                $count_created++;
            } else {
                $data->update($skate, $current_id);
                $count_updated++;
            }
        }
        return redirect('/skates')->with('success', 'Добавлено: ' . $count_created . ' | Обновлено: ' . $count_updated);
    }
}
