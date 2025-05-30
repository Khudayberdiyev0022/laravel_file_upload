<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentEvent
{
  use Dispatchable, SerializesModels;

  public function __construct(
    public array|null|UploadedFile $files,
    public MorphOne|MorphMany|MorphToMany|null $relation = null,
    public string $path = 'files',
    public ?string $identifier = null
  ) {
  }
}
