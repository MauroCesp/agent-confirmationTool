<?php

namespace App\Http\Controllers;


//----------- Request
// Estas librerias son obligatoria para recojer datos por HTTP
use Illuminate\Http\Request;
//use App\Http\Request;

//---------- Para trabajar con bases de datos
use Illuminate\Support\Facades\DB;


//------ STORAGE ARCHIVOS
use Illuminate\Support\Facades\Storage;


//---------------
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Str;

//-----------------  MODELOS  -------------------------------
// --       My MODELS
use App\Models\Journal;
use App\Models\Book;
use App\Models\Database;

// --     CONTROLLERS
use App\Http\Controllers\DbController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\BookController;

class OrderController extends Controller
{

                      /////////////////////////////////////////////////////////////
                      //
                      //                        Primera ronda
                      //
                      //////////////////////////////////////////////////////////////
  /*
  /----------------------------  1  --------------------------------
  //-------------------- ~SEARCH -----------------------------------a
  /-----------------------------------------------------------------
  */
  // LE pasamos el parametro que vienen por la url
  // ES un parametro nulo porque puede venir o no lx1a busqueda
  public function search(Request $request){

    // Vamos a hacer una query en el ojjeto de grupo
    // SI le quito y solo dejo SEARCH me saca los grupos que sear ese titulo
    //$videos = Video::where('title', 'LIKE','%'.$search.'%')->paginate(5);
    //$ovidGroup = $request->input('submit');
    $ovidGroup = $request->input('group');

    $url = 'https://portal.ovid.com/AuthService/api/ServiceUser';
    //$url = 'https://appdevdemo.ovid.com:8443/AuthService/api/ServiceUser';

    #------------------------------------------------------------------------------------------------
    #------------------------   CURL CONNECTION --------------------------------------------
    #------------------------------------------------------------------------------------------------

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
   //This function is identical to calling fopen(), fwrite() and fclose() successively to write data to a file.
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
    $j = (new JournalController)->saveJournal($response,$ovidGroup);
    $d = (new DbController)->saveDB($response,$ovidGroup);
    $b = (new BookController)->saveBook($response,$ovidGroup);

    //-----------------------------------------------------------------------
    //                  CALL TABLES FROM DB  (Journal, Book, Db)
    //-----------------------------------------------------------------------
    // Entonces ya cuardamos la data en las bases de datos temporales
    // Ahora tengo que traer esa data directo desde la base de dedatos
    //  Para ello llamo a mis modelos
    //$journals = Journal::whereNotNull('id')->paginate(10);
    //$books = Book::whereNotNull('id')->paginate(10);
    //$databases = Database::whereNotNull('id')->paginate(10);


    //  Para ello llamo a mis modelos
    $journals = Journal::whereNotNull('id')->paginate(50);
    $books = Book::whereNotNull('id')->paginate(50);
    $databases = Database::whereNotNull('id')->paginate(50);

    //Aqui lo que hacemos es sacar todas las bases que tienen el cliente y se los pasamos a la vista.
    $unique_db = Database::distinct('formatShortName')->pluck('formatShortName');

    // Estos son valores uqe he identificado pero que no queremos utlizar aun
    // Me parece super interesante el OPEN ACCESS value
    $dont_include = array(

        'biopdb' =>'DEFAULT ACCESS - Not a product',
        'oacc'=> 'Ovid Open Access',
        'mjodjnovd'=> ' LWW JOurnals Value Archive',
        'mmdbdb'=> 'Multi Media Linking',

    );

    // Los valores con los que trabajo son los de este array.
    $list_dbs = array(
            'ovftdb' => 'Your Journals@Ovid',
            'emcadb'=> 'Ovid Emcare',
            'ericdb'=> 'ERIC',
            'embase'=> 'EMBASE',
            'medline'=> 'Ovid MEDLINE(R)',
            'ebmr'=> 'EBM Reviews Full Text',
            'jbindb'=> 'Joanna Briggs Institute EBP Database',
            'MWIC'=> 'Maternity & Infant Care Database (MIDIRS)',
            'psycdb'=> 'APA PsycINFO',
            'booksall' => 'Books@Ovid',
            'ebmr'=> 'EBM Reviews (Includes All)',
            'ameddb' => 'AMED- Allied and Complementary Database',
          );

    // AHora regresamos la vista con los VIdeos// Le pasamos un array con los videos
    //$ovidGroup = $request->input('group'); TAMBIEN VOY A PASAR EL GRUPO COM PARAMETRO PARA MOSTRARLO en pantalla
    return view('orders.f_search',array(
        'groups' => $response,
        'journals' => $journals,
        'books' =>$books,
        'databases' =>$databases,
        'group' =>$ovidGroup,
	      'unique_db' =>$unique_db,
	      'list_dbs' => $list_dbs,
    ));

  }


                    /////////////////////////////////////////////////////////////
                    //
                    //                        SUBMITS
                    //
                    /////////////////////////////////////////////////////////////


  public function submit(Request $request){



    $journal = $request->input('journal');
    $book = $request->input('book');
    $database = $request->input('database');
    $group = $request->input('group');

// ------------ CARD 1 ----------------
    // Esta es la mejor forma de obtener los parametro que se generan en la vista
    // NO se el si me llega el nombre o no, entonces cojo todo y recorro el array para ir comprobando si llego
    $query = $request->collect();

// ------------ CARD 2 ----------------
    $silver_chair = $request->input('silver_chair');
    $health_library = $request->input('health_library');
    $bates = $request->input('bates');
    $aclands = $request->input('aclands');
    $fiveMinute = $request->input('fiveMinute');
    // Envio la info como array para cada card
    $list_silver_chair = [$health_library,$bates,$aclands,$fiveMinute];
    //------------------------------------
    $atypon = $request->input('atypon');
    $dual_access = $request->input('dual_access');
    $aha = $request->input('aha');
    $asco = $request->input('asco');
    $aua = $request->input('aua');
    $asa = $request->input('asa');
    // Envio la info como array para cada card
    $list_atypon = [$dual_access,$aha,$asco, $aua, $asa];
    //----------------------------------------

    //------------------------------------
    $more_products = $request->input('more_products');
    $ciam = $request->input('ciam');
    $lipincott = $request->input('lipincott');
    $biodigital = $request->input('biodigital');
    $biocyc = $request->input('biocyc');
    // Envio la info como array para cada card
    $list_more_products = [$ciam,$lipincott,$biodigital, $biocyc];
    //----------------------------------------
    // Esta es la mejor forma de obtener los parametro que se generan en la vista
    // NO se el si me llega el nombre o no, entonces cojo todo y recorro el array para ir comprobando si llego
    $neurology = $request->input('neurology');

// ------------ CARD 3 ----------------
    $oA = $request->input('openAthens');
    $entityID = $request->input('entityID');
    $shibboleth = $request->input('shibboleth');
    $ip_access = $request->input('ip_access');
    // Envio la info como array para cada card
    $list_access = [$oA,$shibboleth,$ip_access];

    $list_names_dbs = array(
      'ovftdb' => 'Your Journals@Ovid',
      'emcadb'=> 'Ovid Emcare',
      'ericdb'=> 'ERIC',
      'embase'=> 'EMBASE',
      'medline'=> 'Ovid MEDLINE(R)',
      'ebmr'=> 'EBM Reviews Full Text',
      'jbindb'=> 'Joanna Briggs Institute EBP Database',
      'MWIC'=> 'Maternity & Infant Care Database (MIDIRS)',
      'psycdb'=> 'APA PsycINFO',
      'booksall' => 'Books@Ovid',
      'ebmr'=> 'EBM Reviews (Includes All)',
      'ameddb' => 'AMED- Allied and Complementary Database',
    );

    // En caso de que existan bases de datos necesito sacar las categorias
    if($database == 'database'){
        // Busco los valores unicos dentro de las mysql_table
        //
        //
        // NEcesito hacer otra filtrado mas y agregar el numero unico de orden
        //
        //
        //
        $categories = Database::distinct('formatShortName')->pluck('formatShortName');

        // Esta vista la regreso si tienen bases de datos
        return view('orders.submit_db',array(
            'journal' =>$journal,
            'book' =>$book,
            'database' =>$database,
            'group' =>$group,
            // Aqui envieo el array con los valores unicos
            'categories' => $categories,
            'query'=>$query,
            'silver_chair'=> $silver_chair,
            'atypon'=> $atypon,
            'health_library'=>$health_library,
            'bates'=>$bates,
            'aclands'=>$aclands,
            'fiveMinute'=>$fiveMinute,
            'oA'=>$oA,
            'shibboleth'=>$shibboleth,
            'ip_access'=>$ip_access,
            'dual_access'=>$dual_access,
            'aha'=>$aha,
            'asco'=>$asco,
            'aua'=>$aua,
            'asa'=>$asa,
            'neurology'=>$neurology,
            'list_silver_chair'=> $list_silver_chair,
            'list_access'=> $list_access,
            'list_atypon'=> $list_atypon,
            'list_more_products'=> $list_more_products,
            'list_names_dbs'=> $list_names_dbs,
            'entityID' =>$entityID

        ));
    }
    // Esta vista la regreso en caso de NO tener bases de datos.
    // La unica diferencia es que no lleva el array con las bases de datos.
    else{
      return view('orders.submit',array(
          'journal' =>$journal,
          'book' =>$book,
          'database' =>$database,
          'group' =>$group,
          'silver_chair'=> $silver_chair,
          'atypon'=> $aytpon,
          'health_library'=>$health_library,
          'bates'=>$bates,
          'aclands'=>$aclands,
          'fiveMinute'=>$fiveMinute,
          'oA'=>$oA,
          'shibboleth'=>$shibboleth,
          'ip_access'=>$ip_access,
          'dual_access'=>$dual_access,
          'aha'=>$aha,
          'asco'=>$asco,
          'aua'=>$aua,
          'asa'=>$asa,
          'neurology'=>$neurology,
          'list_silver_clair'=> $list_silver_clair,
          'list_access'=> $list_access,
           'list_more_products'=> $list_more_products,
          'list_atypon'=> $list_atypon,
          'entityID' =>$entityID

      ));
    }




  }


}
