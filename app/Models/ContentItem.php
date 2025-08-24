<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentItem extends Model
{
    public function contentable()
    {
        return $this->morphTo();
    }
}
