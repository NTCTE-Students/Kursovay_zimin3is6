<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Отобразить список всех объявлений.
     */
    public function index()
    {
        $listings = Listing::with('user')->latest()->get();
        return view('listings.index', compact('listings'));
    }

    /**
     * Показать форму создания нового объявления.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Сохранить новое объявление.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
        ]);

        Listing::create([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('listings.index')->with('success', 'Объявление создано!');
    }

    /**
     * Отобразить конкретное объявление.
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * Показать форму редактирования объявления.
     */
    public function edit(Listing $listing)
    {
        // проверка владельца
        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещён.');
        }

        return view('listings.edit', compact('listing'));
    }

    /**
     * Обновить существующее объявление.
     */
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещён.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
        ]);

        $listing->update($request->only('title', 'description', 'price'));

        return redirect()->route('listings.index')->with('success', 'Объявление обновлено!');
    }

    /**
     * Удалить объявление.
     */
    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещён.');
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Объявление удалено.');
    }
}
