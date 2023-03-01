<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\DbController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\BookController;

use App\Models\Journal;
use App\Models\Book;
use App\Models\Database;


class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(){
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */

   public function index(){
    return view('dashboard');
   }

   // Aqui la request es lo que me llega de la resultado
   // En la ruta recivimos el request del input que meta el usuario
   public function saveTables(Request $request){
     #------------------------------------------------------------------------------------------------
     #------------------------   GET INFO JSON --------------------------------------------
     #------------------------------------------------------------------------------------------------
        // Es un INPUT por que es el NAME or ID que vienen een el formulario que envia la request.
        $ovidGroup = $request->input('group');

        $url = 'https://portal.ovid.com/AuthService/api/ServiceUser';
        //$url = 'https://appdevdemo.ovid.com:8443/AuthService/api/ServiceUser';
        //  Initiate curl

        // Inicializamos el OBJETO CURL
        $ch = curl_init();
        // Disable SSL verification
        // Desabilitamos la verificacion ftp_ssl_connect
        // Seteamos todas nuestras opciones con CURL_SETOPT


        //---------- El servidor envia un certificado indicado su identidad
        // Lo tenemos desabilitado para que la coneccion no falle si no se vefifica el cerfificado
        // This option determines whether curl verifies the authenticity of the peer's certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);


        curl_setopt($ch, CURLOPT_POSTFIELDS,     '{ "username": "CMSLandingPages", "password": "d6787b9c88d9fcbd3f14268348ef78b2" }' );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);


        // Aqui lo que hace es convertirlo en texto
        $response = json_decode($result, true);

        // Aqui envio resultado a un archivo de texto dond elo pueda copiar
        file_put_contents("example.txt", $result);

        #------------------------------------------------------------------------------------------------
        #------------------------   GET ORDERS FORM CUSTOMER --------------------------------------------
        #------------------------------------------------------------------------------------------------

        $tok = $response['access_token'];
        $authorization = "Authorization: Bearer ".$tok;

        $url = 'https://portal.ovid.com/Entitlements/api/Group/'.$ovidGroup;
        //$url = 'https://appdevdemo.ovid.com:8443/Entitlements/api/Group/'.$ovidGroup.'?AdditionalProductClasses=telecom,services';
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        $response = json_decode($result, true);


        //-----------------------------------------------------------------------
        //                  CALL CONTROLLERS (Journal, Book, Db)
        //-----------------------------------------------------------------------
        /*
        // Le paso todo el objeto al controllador para que me extraiga cada campo de la base de datos
        // el FOREACH lo hago dentro del controller cunado voy a guardar los campos en la base de datos.
        */
        // Esta es la forma en que llamas a cada  objeto de la base dedatos.
        $j = (new JournalController)->saveJournal($response);
        $d = (new DbController)->saveDB($response);
        $b = (new BookController)->saveBook($response);

        //-----------------------------------------------------------------------
        //                  CALL TABLES FROM DB  (Journal, Book, Db)
        //-----------------------------------------------------------------------

        $journals = Journal::whereNotNull('id')->get();



        /*
        #------------------------------------------------------------------------------------------------
        #------------------------   RETURN VIEW --------------------------------------------
        #------------------------------------------------------------------------------------------------
        */
        return view('orders.search',array(
          'journals' => $journal,
          'books' =>$book,
          'databases' =>$database
        ));

      }
}
