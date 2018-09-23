<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Empresa;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('empresa')) {
          $users = User::where('empresa_id', $request->get('empresa'))->paginate();
          return view('admin.empresas.users.index', compact('users'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        $roles = Role::all();

        return view('admin.users.create', compact('empresas', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255|same:password_confirm',
            'password_confirm' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        if($data['role_id'] == 1) {
          $userRole = Role::where('name', '=', 'Admin')->first();
        } elseif($data['role_id'] == 2) {
          $userRole = Role::where('name', '=', 'User')->first();
        } elseif($data['role_id'] == 3) {
          $userRole = Role::where('name', '=', 'User Lite')->first();
        }

        //$user->detachAllRoles();
        $user->attachRole($userRole);

        flash('Usuário adicionado com sucesso!')->success()->important();

        $params = [];

        if(!empty($user->empresa_id)) {
          $params = [
            'empresa' => $user->empresa_id
          ];
        }

        return redirect()->action('UsersController@index', $params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $empresas = Empresa::all();
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'empresas', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $user = User::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;
        $data['password'] = bcrypt($data['password']);

        if($data['role_id'] == 1) {
          $userRole = Role::where('name', '=', 'Admin')->first();
        } elseif($data['role_id'] == 2) {
          $userRole = Role::where('name', '=', 'User')->first();
        } elseif($data['role_id'] == 3) {
          $userRole = Role::where('name', '=', 'Unverified')->first();
        }

        $user->detachAllRoles();
        $user->attachRole($userRole);

        $user->update($data);

        flash('Usuário atualizado com sucesso!')->success()->important();

        $params = [];

        if(!empty($user->empresa_id)) {
          $params = [
            'empresa' => $user->empresa_id
          ];
        }

        return redirect()->action('UsersController@index', $params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $registro = User::findOrFail($id);
            $registro->delete();

            return response()->json([
              'code' => 201,
              'message' => 'Removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
              'code' => 501,
              'message' => $e->getMessage()
            ]);
        }
    }

    public function logo(Request $request)
    {
      if(!$request->has('logo')) {
        return false;
      }

      $logo = $request->get('logo');

      $file = \Storage::disk('local')->get($logo);

      return \Image::make($file)->resize(64, 64)->response('jpg');

      return response($image, 200)->header('Content-Type', 'image/jpeg');
    }

    public function avatar(Request $request)
    {
        $user = \Auth::user();

        if($request->has('email')) {
          $user = User::where('email', $request->get('email'))->get()->first();
        }

        if($user->avatar_tipo == 'social') {

          $file = file_get_contents($user->social_avatar);
          return response($file, 200)->header('Content-Type', 'image/jpeg');

        } elseif($user->avatar_tipo == 'upload') {

          $file = \Storage::disk('local')->get($user->avatar);
          return response($file, 200)->header('Content-Type', 'image/jpeg');

        } elseif($user->avatar_tipo == 'words') {

          $file = file_get_contents(\Avatar::create($user->name)->setDimension(300, 300)->setFontSize(85)->setShape('square')->setBorder(0, '#aabbcc')->toBase64());
          return response($file, 200)->header('Content-Type', 'image/jpeg');

        } else {

          $file = file_get_contents(\Gravatar::get($user->email));
          return response($file, 200)->header('Content-Type', 'image/png');
        }
    }
}
