<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Link extends Model
{
    use HasFactory;

    /** @var string[] */
    public $translatable = [
     //   'title',
     //   'description',
    ];

    protected $table = 'links';
    protected $fillable = ['url','foruse','title','description','color'];
}
