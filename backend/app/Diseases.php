<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diseases extends Model
{
    use SoftDeletes;

    protected $table = 'diseases';

    protected $fillable = [
        'code',
        'name',
        'solution'
    ];
}