<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscarpor');

        $tipo = $request->get('tipo');


        $doctors = User::doctors()->buscarpor($tipo, $buscar)->paginate(5);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',
        ];
        $this->validate($request, $rules);

        // mass assignment ---> asignacion masiva
        User::create($request->only('name','lastname','email','dni','address','phone')
        + [
            'role' => 'doctor',
            'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'El médico(a) se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
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
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
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
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',
        ];
        $this->validate($request, $rules);

        $user = User::doctors()->findOrFail($id);

        $data =  $request->only('name','lastname','email','dni','address','phone');
        $password = $request->input('password');

        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save(); //UPDATE

        $notification = 'La información del médico(a) se ha actualizado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();

        $notification = "El médico(a) $doctorName se ha eliminado correctamente";
        return redirect('/doctors')->with(compact('notification'));
    }
}
