<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 'title', 'site_url', 'start_date', 'finish_date', 'description'];

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
