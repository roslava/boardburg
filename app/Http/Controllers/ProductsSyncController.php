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
        $products = $data->index();

        $count_created = 0;
        $count_updated = 0;
        foreach ($products as $product) {
            $current_id = $product['id'];
            $current = Product::where('external_id', '=', $current_id)->first();
            if ($current === null) {
                $data->store($product);
                $count_created++;
            } else {
                $data->update($product, $current_id);
                $count_updated++;
            }
        }
        return redirect('/products')->with('success', 'Добавлено: ' . $count_created . ' | Обновлено: ' . $count_updated);
    }
}
