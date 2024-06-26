<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['title'];

  public function icon(): \Illuminate\Database\Eloquent\Relations\MorphOne
  {
    return $this->morphOne(Attachment::class, 'attachment');
  }
}
