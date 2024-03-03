<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Board extends Model
{
    use HasFactory,HasUuids;

    protected $table = "board";

    protected $fillable = [
        "title",
        "content",
        "category",
        "kind",
    ];
}
