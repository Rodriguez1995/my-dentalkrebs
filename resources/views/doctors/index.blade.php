@extends('layouts.panel')

@section('content')

<div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Médicos</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors/create') }}" class="btn btn-sm btn-success">Nuevo médico
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if (session('notification'))
              <div class="alert alert-success" role="alert">
                {{ session('notification') }}
              </div>
              @endif
            </div>

    <nav class="navbar navbar-light float-right">
        <form class="form-inline">

        <select name="tipo" class="form-control form-control-sm" id="exampleFormControlSelect1">
          <option>Buscar por tipo</option>
          <option>name</option>
          <option>email</option>
          <option>dni</option>
        </select>

        <input name="buscarpor" class="form-control form-control-sm" type="search" placeholder="Buscar por nombre" aria-label="Search">

        <button class="btn btn-sm btn-info" type="submit">Buscar</button>
        </form>
      </nav>

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach ($doctors as $doctor)
                  <tr>
                    <th scope="row">
                      {{ $doctor->name }}
                    </th>
                    <td>
                      {{ $doctor->email }}
                    </td>
                    <td>
                      {{ $doctor->dni }}
                    </td>
                    <td>
                    	
                      <form action="{{ url('/doctors/'.$doctor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{ url('/doctors/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>

                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <div class="card-body">
              {{ $doctors->links() }}
            </div>
          </div>
@endsection
