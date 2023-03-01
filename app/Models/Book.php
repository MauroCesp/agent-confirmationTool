<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  //Primero le decimos a que tabla hace referencia este MODELOS
  // creamos una propiedad protegida que indica que tabla buscamos
  // El modelo queda enlazado con esa tabla
  protected $table = 'books';

  // Ahora definimos la relacion con cada una de las entidades
}
