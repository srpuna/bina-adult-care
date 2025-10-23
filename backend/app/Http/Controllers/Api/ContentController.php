<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page');
        if ($page) {
            $items = Content::where('page', $page)->get();
        } else {
            $items = Content::all();
        }
        return response()->json($items);
    }

    public function upsert(Request $request)
    {
        $data = $request->validate([
            'page' => 'required|string',
            'key' => 'required|string',
            'value' => 'nullable',
        ]);

        $item = Content::updateOrCreate([
            'page' => $data['page'],
            'key' => $data['key'],
        ], ['value' => $data['value']] );

        return response()->json($item);
    }
}
