<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectData extends Model
{
  //Primero le decimos a que tabla hace referencia este MODELOS
  // creamos una propiedad protegida que indica que tabla buscamos
  // El modelo queda enlazado con esa tabla
  protected $table = 'selectData';

  // Ahora definimos la relacion con cada una de las entidades
}
