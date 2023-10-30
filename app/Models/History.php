<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    public static function log($model, $new)
    {
        $modelClass = '\\App\\Models\\' . $model;
        $old = $modelClass::find($new->id)->toArray();

        $h = new self;
        $h->user_id = Auth::id();
        $h->data = serialize(array_diff_assoc($new->toArray(), $old));
        $h->model = $model;
        $h->save();
    }
}
