<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etkinlik extends Model
{
    use HasFactory;

    protected $table = 'etkinlikler';

    protected $fillable = ['OGR_NO', 'BIRIM_ICI', 'BIRIM_DISI', 'AYNI_FAKULTE', 'ETKINLIK_ADI', 'KATILIM', 'EKTINLIK_KEY'];
}
