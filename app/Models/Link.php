<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Link extends Model
{
    use HasFactory;
    use HasTranslations;

    /** @var string[] */
    public $translatable = [
     //   'title',
     //   'description',
    ];

    protected $table = 'links';
    protected $fillable = ['url','foruse','title','description','color'];
}
