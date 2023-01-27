<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Validator;
use Auth;
use DB;
// use Illuminate\Validation\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin', ['except' =>['show','password', 'updatePassword']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('users.index' , compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $this->validate($request, 
        [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'    => 'required',
            'password-confirm' => 'required_with:password|same:password|min:6',
            'role'   => 'required',
        ],
        [
        'name.required' => 'El campo nombre completo es obligatorio',
        'name.min' => 'El campo nombre debe tener 6 caracteres como minimo',
        'email.required' =>'El campo Email es obligatorio',
        'email.email' => 'El campo Email debe ser un email válido',
        'password.required' => 'El campo Contraseña es obligatorio',
        'password.min' => 'El campo Contraseña debe tener 6 caracteres como minimo',
        'password-confirm.required' => 'El campo Repita Contraseña es obligatorio',
        'password-confirm.min' => 'El campo Repita Contraseña debe tener 6 caracteres como minimo',
        ]
    );

    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = bcrypt($request->password);
    $usuario->role = $request->role;
    $usuario->save();

    return redirect('users')->with('success', 'Se ha creado el usuario '.$request->name);

        // User::create($request->all());

        // return response()->json([
        //     'success'    => true,
        //     'message'    => 'Users Created'
        // ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $form_data = array('route' => array('users.update', $user->id), 'method' => 'PATCH');
        $action    = 'Editar';

        return view('users.edit', compact('user','form_data','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         // dd($empresa, $request);

         $data = $this->validate($request, 
         [
             'name'=>'required|min:3',
             'password' => 'required',
             'password-confirm' => 'required_with:password|same:password'      
         ],
         [
             'name.required' => 'El campo nombre completo es obligatorio',
             'name.min' => 'El campo nombre debe tener 6 caracteres como minimo',
             'email.required' =>'El campo Email es obligatorio',
             'email.email' => 'El campo Email debe ser un email válido',
             'password.required' => 'El campo Contraseña es obligatorio',
             'password.min' => 'El campo Contraseña debe tener 6 caracteres como minimo',
             'password-confirm.required' => 'El campo Repita Contraseña es obligatorio',
             'password-confirm.min' => 'El campo Repita Contraseña debe tener 6 caracteres como minimo',  
         ]
     );
 
         // dd($empresa->name); 
 
      $user =  User::find($user->id);
    //   $usuario = Auth::user($user->id);
        $data = Input::all();
        $data['password'] = bcrypt($data['password']);

        $user->fill($data);
        $user->save();
        return view('users.show', compact('user'));
        // return Redirect::route('users.show', array($user->id));

        // if ($user->isValid($data))
        // {
        //     // Si la data es valida se la asignamos al usuario
        //     $user->fill($data);
        //     // Guardamos el usuario
        //     $user->save();
        //     // Y Devolvemos una redirección a la acción show para mostrar el usuario
        //     return Redirect::route('users.show', array($user->id));
        // }
        // else
        // {
        //     // En caso de error regresa a la acción edit con los datos y los errores encontrados
        //     return Redirect::route('users.edit', $user->id)->withInput()->withErrors($user->errors);
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('users')->with('success', 'Se ha eliminado el usuario ');
    }

    public function apiUsers()
    {
        $user = User::all();

        return Datatables::of($user)
            ->addColumn('action', function($user){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $user->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $user->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function password(){
        return View('user.password');
    }

    public function updatePassword(Request $request, User $user){

        $rules = array(
            'password' => 'required',
            'newpassword' => 'required|min:5',
            'repassword' => 'required|same:newpassword'
        );

        $messages = array(
                'required' => 'El campo :attribute es obligatorio.',
                'min' => 'El campo :attribute no puede tener menos de :min carácteres.'
        );
            if(Auth::user()->id == $user->id)
            {
            $request->user()->fill(['password' => Hash::make($request->newpassword)])->save();
            return redirect('home')->with('success', Auth::user()->name .' rol '. Auth::user()->role .' Nueva contraseña guardada correctamente para '. $user->name);
            }else
            {
                return redirect('home')->with('danger', Auth::user()->name .' rol '. Auth::user()->role .' No tiene permiso! sobre '. $user->name);
            }
    }

    public function updatePasswordAdmin(Request $request){

        $rules = array(
            'password' => 'required',
            'newpassword' => 'required|min:5',
            'repassword' => 'required|same:newpassword'
        );

        $messages = array(
                'required' => 'El campo :attribute es obligatorio.',
                'min' => 'El campo :attribute no puede tener menos de :min carácteres.'
        );

        $request->user()->fill(['password' => Hash::make($request->newpassword)])->save();
        return redirect('home')->with('success', 'Nueva contraseña guardada correctamente');
    }

    public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|email|unique:users',
            'email' => 'required|min:4|max:40',
            'password'  => 'min:8|confirmed'
        );
        
        // Si el usuario existe:
        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
        $rules['email'] .= ',email,' . $this->id;
        }
        else // Si no existe...
        {
            // La clave es obligatoria:
            $rules['password'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function log()

    {
        DB::enableQueryLog();
    $log = DB::getQueryLog();
    var_dump($log);
    // Multiples conexiones
    DB::connection('connection1')->enableQueryLog();
    DB::connection('connection1')->getQueryLog();
    DB::connection('connection2')->enableQueryLog();
    DB::connection('connection2')->getQueryLog();
    }

}
