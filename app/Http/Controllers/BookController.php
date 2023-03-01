<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\SelectData;

class BookController extends Controller
{
  /*
  /-----------------------------------------------------------------------------
  //--------------------   Guardar BOOK   ----------------------------------
  /-----------------------------------------------------------------------------
  */


  // Cunado llamo al metodo de saveVIdeo dentro de la ruta se ejecuta la accion que tenga en ele controlador.
  // Asi recibimos los datos que paso en el controllador HOME
  public function saveBook($response,$ovidGroup){
        //-------- ERRASE DATABASE----------------

        // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
        // Estonces lo que hago es borrala y volverla a escribir.
        // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
        Book::whereNotNull('id')->delete();

          // Esto es todo el objeto JSON
          foreach ($response as $result) {

            // -------- NUEVA CARGA -----------
            // Creo una variable para guarda un objeto nuevo
            $book = new Book();
              // Recorro cada ELEMENTO del JSON
              // Dentro de cada elemento voy a tener la info

              // ---------Escojer journals --------------
              if( $result['productClass'] == 'book'){

                  //--- Asigno variables dentro del objeto VIDEO
                  // Voy metiendo todo lo que me llega por la request dentro de video
                  // Es decir cada uno de estas variables con las que tengo en la base de datos.
                  $book -> cust_group = $ovidGroup;
                  $book -> shortName = $result['shortName'];
                  $book -> orderNumber = $result['orderNumber'];
                  $book -> vendor = $result['vendor'];
                  $book -> isbn = $result['isbn'];
                  $book -> title = $result['title'];
                  $book -> edition = $result['edition'];
                  $book -> productClass = $result['productClass'];
                  $book -> jumpStart = $result['jumpStart'];
                  $book -> publisher = $result['publisher'];

                  $book-> save();

                }

              }
      // Asi es como se gurada un video en la base de datos


    }

  public function selectBook(Request $request){

          //-------- ERRASE DATABASE----------------

          // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
          // Estonces lo que hago es borrala y volverla a escribir.
          // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
          SelectData::whereNotNull('id')->delete();


          $arrayAll = $request->all();

          //saco el numero de elementos
          $longitud = count($arrayAll['book']);

          $group = $request->input('group');
          $order = $request->input('order');

          foreach (range(0, $longitud-1) as $i) {
              // -------- NUEVA CARGA -----------
              // Creo una variable para guarda un objeto nuevo
              $database = new SelectData();

              //--- Asigno variables dentro del objeto VIDEO
              // Voy metiendo todo lo que me llega por la request dentro de video
              // Es decir cada uno de estas variables con las que tengo en la base de datos.
              $database -> selection_id = $arrayAll['book'][$i];
              $database -> type = 'book';

              // Como recibo la request con los parametros del formulario
              // YA puedo llamar los INPUTS del formulario con el NAME y ID desde la request
              $database -> groups = $request->input('group');
              $database ->  orders = $request->input('order');

              $database-> save();
            }

            // Este es la forma en que envio un a alert al mismo
            // Tambien le paso parametros con WITH y los llamo con SESSION en la vista
            return redirect()->back()->with('message', $longitud.' BOOK items have been added to your selection.' )->with('longitudBook',$longitud);
    }

}
