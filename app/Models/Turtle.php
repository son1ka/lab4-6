<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turtle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'modal_description',
        'latin_name',
        'image_path',
    ];

    // Приводит латинское название к нижнему регистру при сохранении
    public function setLatinNameAttribute($value)
    {
        $this->attributes['latin_name'] = strtolower($value);
    }

    // Отображает первую букву латинского названия заглавной
    public function getFormattedLatinNameAttribute()
    {
        return ucfirst($this->latin_name);
    }

    // Метод для формирования данных для модального окна
    public function toArrayForModal()
    {
        return [
            'title' => $this->title,
            'description' => str_replace(['<br>', '<span', '</span>'], ['\n', '<span', '</span>'], $this->modal_description),
            'image' => URL::asset($this->image_path),
        ];
    }
}
