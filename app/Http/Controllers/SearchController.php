<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function viewSearchPage(Request $request)
    {
        $validated_request = $request->validate([
            'query' => ['nullable', 'string', 'min:1', 'max:100'],
            'order_by' => ['nullable', 'string', 'in:rating,price'],
            'asc' => ['nullable', 'boolean']
        ]);

        $validated_request['order_by'] = $validated_request['order_by'] ?? 'rating';
        $validated_request['asc'] = $validated_request['asc'] ?? true;
        $validated_request['query'] = $validated_request['query'] ?? '';

        $products = Product::where('name', 'like', '%' . $validated_request['query'] . '%')
            ->orderBy($validated_request['order_by'], $validated_request['asc'] ? 'asc' : 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('guest.search', [
            'products' => $products
        ]);

    }
}
