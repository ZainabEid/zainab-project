{!! Form::model($user, ['data-url'=>route('admin.users.update', $user->id) , 'method' => 'put' , 'class' => 'update-user']) !!}

{{-- option 1 : in one line --}}
{{-- <input 
    type="{{ $name == 'photo' ? 'file' : $name }}" 
    name="{{ $name }}" @if($name != 'photo') 
    value="{{ old($value) }}" @endif> --}}

{{-- option 2 : using laravel collective --}}

@if ($name == 'email')
{!! Form::email($name, null) !!}

@elseif ($name == 'password')
{!! Form::password($name) !!}


@elseif ($name == 'photo' )
{!! Form::file($name) !!}

@else 
{!! Form::text($name, null) !!}


@endif

{{-- validation errors --}}
<span class="text-danger {{ $name }}Error" ></span>

{{-- update btn --}}
{!! Form::button('<i class="fa fa-check fa-2" ></i>', ['type' => 'submit', 'class'=> ' btn btn-success  float-right btn-xs']) !!}

{{-- cancel btn --}}
<a href="#" class=" cancel-update btn btn-warning  float-right btn-xs"
data-id="{{ $user->id }}" data-key="{{ $name }}" ><i class="fa fa-times fa-2" ></i></a>

{!! Form::close() !!}