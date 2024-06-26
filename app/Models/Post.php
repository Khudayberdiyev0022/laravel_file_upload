<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

  protected $fillable = ['name', 'body'];

  public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
  {
    return $this->morphMany(Attachment::class, 'attachment');
  }
}
