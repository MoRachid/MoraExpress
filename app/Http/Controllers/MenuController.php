<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Rules\RestoCategoryValidate;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($id)
    {
        $restoId = $id;
        $restoService = new MenuService;
        $menus = $restoService->getMenuWithCategory($restoId);

        if(!$menus) {
            abort(400, 'Wrong resto');
        }

        return view('menus.menu-index')
            ->with('restoId', $restoId)
            ->with('menus', $menus);
    }

    public function saveMenuItem(Request $request)
    {
        $postData = $this->validate($request, [
            'item' => 'required|min:3',
            'price' => 'required|numeric',
            'restoId' => 'required|numeric',
            'description' => 'required|min:3',
            'category' => ['required', new RestoCategoryValidate(request('restoId'))],
        ]);

        $category = Category::where('resto_id', $postData['restoId'])
                        ->where('name', $postData['category'])
                        ->first();
        
        $menu = Menu::create([
            'name' => $postData['item'],
            'price' => $postData['price'],
            'description' => $postData['description'],
            'resto_id' => $postData['resto_id'],
            'category_id' => $category->id,
        ]);

        return response()->json($menu, 201);
    }

    public function getRestoMenu(Request $request)
    {
        $this->validate($request, [
            'restoId' => 'required|exists:restaurants.id',
        ]);

        $menuItems = Menu::where('resto_id', $request->input('restoId'))
            ->orderBy('category_id')
            ->get();

        return response()->json($menuItems, 200);

    }
}
