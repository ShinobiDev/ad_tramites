<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleClicAnuncio extends Model
{
    //
    protected $fillable =['id_usuario','id_anuncio','costo','num_visitas'];
}
