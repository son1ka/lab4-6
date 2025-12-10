<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TurtleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turtles = Turtle::all();
        return view('turtles.index', compact('turtles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('turtles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'modal_description' => 'required|string', // Добавляем валидацию
            'latin_name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Обработка загрузки изображения
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/images'), $imageName);

        // Создание записи в БД
        Turtle::create([
            'title' => $request->title,
            'description' => $request->description,
            'modal_description' => $request->modal_description, // Сохраняем подробное описание
            'latin_name' => $request->latin_name,
            'image_path' => 'storage/images/' . $imageName,
        ]);

        return redirect()->route('turtles.index')->with('success', 'Черепаха успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turtle $turtle)
    {
        return view('turtles.show', compact('turtle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Turtle $turtle)
    {
        return view('turtles.edit', compact('turtle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turtle $turtle)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'modal_description' => 'required|string',
            'latin_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Подготовка данных для обновления
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'modal_description' => $request->modal_description,
            'latin_name' => $request->latin_name,
        ];

        // Если загружено новое изображение
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/images'), $imageName);
            $data['image_path'] = 'storage/images/' . $imageName;
        }

        $turtle->update($data);

        return redirect()->route('turtles.index')->with('success', 'Черепаха успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turtle $turtle)
    {
        $turtle->delete();

        return redirect()->route('turtles.index')->with('success', 'Черепаха успешно удалена!');
    }
}
