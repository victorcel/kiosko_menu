<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Cliente;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

Auth::routes();


Route::get('puntos', function () {
    $sumar = 0;
    $filas = 0;
    $acct = 100092730;
    $validar = DB::select('SELECT COUNT(datePoint)as resl FROM updatepoints WHERE datePoint=CURDATE()');
    //return dd($validar[0]->resl);
    if (0 == $validar[0]->resl) {
        $users = DB::connection('sqlsrv')->select("exec spRptPointsJournal
      @Acct = N'100041180',
      @StartDt = N'08/15/2017',
      @EndDt = N'10/15/2017'");//@Acct = N'100092730' @Acct = N'100137111',//->select('select * from tAccessLevel');
        //SELECT SUM(netpts)as Resultado, lastname, firstname, acct FROM `clientes` WHERE netpts>=0  GROUP BY acct having Resultado>4000/*and acct =100092730
        // dd($users);

        foreach ($users as $user) {
            $cliente = new Cliente;
            $cliente->acct = '%2862' . $user->Acct . '?';
            $cliente->lastname = $user->LastName;
            $cliente->firstname = $user->FirstName;
            //  $cliente->netpts = $user->Value5;
            $cliente->netpts = $user->NetPts;
            $cliente->save();
        }
        //DB::select('CALL Puntos()');
    } else {
        return "El dia de hoy Ya fue actualizado los puntos";
    }
    //$total = DB::table('users')->simplePaginate(5);
    //$total=Cliente::where('netpts','>=','0')        ->groupBy('acct')        ->get();
    //return dd($total);
    //   dd($total);
    // return view('welcome', compact('total'));
});
Route::get('consulta', function () {
    $user = new User;
    $user->email=100129302;
    $user->name="ANDERSEN";
    $user->last_name="DAVID MICHAEL";
    $user->password=bcrypt(605973);
    $user->username=100129302;
    $user->save();
    return "Ya termino";
    /*  $users = DB::connection('sqlsrv')->select("exec spGetAwardActivityHourPoints @CasinoID=N'1',@PlayerID=10003152,@AccumulatorPeriod=N'H',@ShowAvgBetTime=0,@ShowByDepartment=1,@DebugLevel=0,@IsTierPoint=0");
      return $users;*/
    /*$consultas = DB::connection('sqlsrv')->select("select '%2862'+CAST( tPlayerCard .Acct  AS VARCHAR(10))+'?' as PlayerId,tPlayerIdentType .PlayerIdentity , tPlayerCard .Acct ,tPlayer.FirstName ,tPlayer.LastName
                    from tPlayer ,tPlayerCard ,tPlayerIdentType
                    where tPlayer .PlayerId = tPlayerCard .PlayerId and
                    tPlayer .PlayerId = tPlayerIdentType .PlayerId and tPlayerCard .Acct >= 100013867 and tPlayer.FirstName not like '/'
                    --and tPlayerCard .Acct = '100092730'");
    //DB::insert("INSERT  INTO users(name, last_name, username, email, password) VALUES ('CARLOS','PEREZ',999999986,999999986,'%2862999999986?')");
    foreach ($consultas as $consulta){
        $user = new User;
        $user->email=$consulta->PlayerId;
        $user->name=$consulta->FirstName;
        $user->last_name=$consulta->LastName;
        $user->password=bcrypt($consulta->PlayerIdentity);
        $user->username=$consulta->Acct;
        $user->save();
    }
    DB::select('ALTER IGNORE TABLE users ADD UNIQUE INDEX(email)');
    return redirect()->route('punto')->with('message', 'El dia de hoy se actualizaron los usuarios');

    //  return date ( format [timestamp] );


     */
    // str_is(Request::ip());
    //$dato=strval(Request::ip());
    //return "smb://guest:123456@".\Request::ip()."/tg2480-h";//;
});
/*
Route::post('/tarjeta', 'ClienteController@con_tarjeta')->name('tarjeta');
Route::get('/cedula', 'ClienteController@con_cedula')->name('cedula');*/

//Route::get('/', 'WelcomeController@index')->name('welcome.index');
Route::get('boletas/{id}', function ($id) {
    $consulta = DB::connection('sqlsrv')->select("select tPlayer.PlayerId from tPlayer ,tPlayerCard ,tPlayerIdentType where tPlayer.PlayerId = tPlayerCard.PlayerId and tPlayer .PlayerId = tPlayerIdentType .PlayerId and tPlayerCard .Acct=".$id);
    foreach ($consulta as $punto){
        $datos= DB::connection('sqlsrv')->select("exec spGetAwardActivityHourPoints @CasinoID = N'1',@PlayerID =" .$punto->PlayerId.",@AccumulatorPeriod = N'H',@ShowAvgBetTime = 0,@ShowByDepartment = 1,@DebugLevel = 0,@IsTierPoint = 0");
        foreach ($datos as $consulta){
            $cliente = new Cliente;
            $cliente->fecha=substr($consulta->Period,4,12);
            $cliente->puntos=$consulta->Base;
            $cliente->save();
        }
        // return $punto->PlayerId;
        return "ya";
    }

    //$puntos = DB::connection('sqlsrv')->select(" exec spGetAwardActivityHourPoints @CasinoID = N'1',@PlayerID = 10003152,@AccumulatorPeriod = N'H',@ShowAvgBetTime = 0,@ShowByDepartment = 1,@DebugLevel = 0,@IsTierPoint = 0

});

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/home1', 'WelcomeController@index')->name('welcome.index');
Route::get('/home', 'WelcomeController@category')->name('welcome.cate');

Route::bind('product', function ($slug) {
    return App\Product::where('slug', $slug)->first();
});
Route::get('products/{slug}', [
    'as' => 'products.show',
    'uses' => 'WelcomeController@show'
]);
Route::get('categories/{slug}', [
    'uses' => 'WelcomeController@searchCategory',
    'as' => 'welcome.search.category'
]);

Route::get('cart/show', [
    'as' => 'cart.show',
    'uses' => 'CartController@show'
]);
Route::get('cart/delete/{product}', [
    'as' => 'cart.delete',
    'uses' => 'CartController@delete'
]);

Route::get('categories/cart/add/{product}', [
    'as' => 'cart.add',
    'uses' => 'CartController@add'
]);
Route::get('products/cart/add/{product}', [
    'as' => 'products.cart.add',
    'uses' => 'CartController@add'
]);
Route::get('categories/cart/confir/{product}', [
    'as' => 'cart.confir',
    'uses' => 'CartController@confir'
]);
Route::get('products/cart/confir/{product}', [
    'as' => 'products.cart.confir',
    'uses' => 'CartController@confir'
]);
Route::get('cart/trash', [
    'as' => 'cart.trash',
    'uses' => 'CartController@trash'
]);

Route::get('cart/update/{product}/{quantity?}', [
    'as' => 'cart.update',
    'uses' => 'CartController@update'
]);
Route::get('order-detail', [
    'middleware' => 'auth',
    'as' => 'order.detail',
    'uses' => 'CartController@orderDetail'
]);
Route::get('payment', 'PaypalController@getPaymentStatus')->name('payment');

Route::get('payment/status', [
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus'
]);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('home', function () {
        return view('admin.home');
    })->name('admin.home');
    Route::get('punto',function (){
        return view('admin.puntos');
    })->name('punto');
    Route::post('/puntos', 'Admin\UsersController@puntos')->name('puntos');
    Route::resource('categories', 'Admin\CategoriesController');
    Route::get('categories/{id}/destroy', 'Admin\CategoriesController@destroy')->name('categories.destroy');
    /*Route::get('categories/{id}/destroy', [
        'as' => 'categories.destroy',
        'uses' => 'Admin\CategoriesController@destroy'
    ]);*/
    //   Route::resource('products', 'Admin\ProductsController');
    Route::get('products', 'Admin\ProductsController@index')->name('products.index');
    Route::get('products/create', 'Admin\ProductsController@create')->name('products.create');
    Route::put('products/{id}', 'Admin\ProductsController@update')->name('products.update');
    Route::get('products/{id}/edit', 'Admin\ProductsController@edit')->name('products.edit');
    Route::post('/products', 'Admin\ProductsController@store')->name('products');
    Route::get('products/{id}/destroy', 'Admin\ProductsController@destroy')->name('products.destroy');
    /*    Route::get('products/{id}/destroy', [
            'as' => 'admin.products.destroy',
            'uses' => 'Admin\ProductsController@destroy'
        ]);*/
    Route::resource('users', 'Admin\UsersController');
    Route::get('users/{id}/destroy', 'Admin\UsersController@destroy')->name('users.destroy');
    //  Route::get('users/{id}/destroy','Admin\UsersController@destroy')->name('users.destroy');
    Route::get('orders', 'Admin\OrderController@index')->name('admin.orders.index');
    Route::get('orders/{id}/destroy', 'Admin\OrderController@destroy')->name('admin.orders.destroy');
    Route::post('orders/get-items', [
        'as' => 'admin.orders.getItems',
        'uses' => 'Admin\OrderController@getItems'
    ]);

});
