<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::Orderid();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        $message = $user ? 'Usuario agregado correctamente' : 'El usuario NO pudo agregarse';
        return redirect()->route('users.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // $request = $request->all();
        // $user->fill($request)->save();
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update($request->only('name', 'email', 'last_name', 'username', 'type', 'address'));
        $message = $user ? 'Usuario actualizado correctamente' : 'El usuario NO pudo actualizarse';
        return redirect()->route('users.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $message = $user ? 'Usuario eliminado correctamente' : 'El usuario NO pudo eliminarse';
        return redirect()->route('users.index')->with('message', $message);
    }

    public function puntos(Request $request)
    {
       // return f_inicio;
        $validar = DB::select('SELECT COUNT(datePoint)as resl FROM updatepoints WHERE datePoint=CURDATE()');
        //return dd($validar[0]->resl);
        if (0 == $validar[0]->resl) {
            $users = DB::connection('sqlsrv')->select("call spRptPointsJournal  @StartDt = N'" . $request->f_inicio . "', @EndDt = N'" . $request->f_fin . "'");//@Acct = N'100092730' @Acct = N'100137111',//->select('select * from tAccessLevel');
            //SELECT SUM(netpts)as Resultado, lastname, firstname, acct FROM `clientes` WHERE netpts>=0  GROUP BY acct having Resultado>4000/*and acct =100092730
            //   dd($users);

            foreach ($users as $user) {
                $cliente = new Cliente;
                $cliente->acct = '%2862' . $user->Acct . '?';
                $cliente->lastname = $user->LastName;
                $cliente->firstname = $user->FirstName;
                $cliente->netpts = $user->NetPts;
                $cliente->save();
            }
            DB::select('CALL Puntos()');
        } else {
            return redirect()->route('punto')->with('message', 'El dia de hoy se actualizaron los puntos');
        }
          return redirect()->route('punto')->with('message', 'Puntos Fueron Actualizados correctamente');
    }
}
