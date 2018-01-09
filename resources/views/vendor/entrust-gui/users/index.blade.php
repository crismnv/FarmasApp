@extends(Config::get('entrust-gui.layout'))

@section('heading', 'Users')

@section('main-content')
<div class="models--actions">
    {{-- <a class="btn btn-labeled btn-primary" href="{{ route('entrust-gui::users.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span> Crear Usuario</a> --}}
</div>
<table class="table table-striped">
  <tr>
    <th>Correo</th>
    <th>Acciones</th>
  </tr>
  @foreach($users as $user)
    <tr>
      <td>{{ $user->email }}</th>
      <td class="col-xs-5">
        <form action="{{ route('entrust-gui::users.destroy', $user->id) }}" method="post">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a  style= "color: #FFF;" class="btn btn-labeled btn-success btn-default" href="{{ route('entrust-gui::users.edit', $user->id) }}"><span  class="btn-label"><i class="fa fa-pencil"></i></span>Editar</a>
          <a class="btn btn-labeled btn-warning" href="{{ url('users/modificarpersonales/' . $user->id)  }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar Datos Personales</a>
          {{-- <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Ver Datos Personales</button> --}}
          <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Borrar</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
<div class="text-center">
  {!! $users->render() !!}
</div>
@endsection
