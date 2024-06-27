<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\URL;

class Attachment extends Model
{
  use HasFactory;

  protected $fillable = ['attachment_id', 'attachment_type', 'name', 'size', 'type', 'path', 'extra_identifier'];

  public function url(): Attribute
  {
    return Attribute::make(fn(): string => URL::to('storage/'.$this->path));
  }

  public function attachment(): MorphTo
  {
    return $this->morphTo();
  }
}
