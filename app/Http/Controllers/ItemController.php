<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $item =  item::select('id', 'name', 'price', 'is_selling')
            ->get();

        return Inertia::render('Items/Index', [
            'items' => $item
        ]);
    }

    public function create()
    {
        return Inertia::render('Items/Create');
    }

    public function store(StoreItemRequest $request)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'memo' => ['required'],
            'price' => ['required'],
        ]);


        Item::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'price' => $request->price,
        ]);

        return to_route('items.index')
            ->with([
                'message' => '登録しました。',
                'status' => 'success'
            ]);
    }

    public function show(Item $item)
    {
        return Inertia::render('Items/Show', [
            'item' => $item
        ]);
    }

    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', [
            'item' => $item
        ]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->memo = $request->memo;
        $item->price = $request->price;
        $item->is_selling = $request->is_selling;
        $item->save();

        return to_route('items.index')->with([
            'message' => '更新しました。',
            'status' => 'success'
        ]);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return to_route('items.index')->with([
            'message' => '削除しました。',
            'status' => 'danger'
        ]);
    }
}
