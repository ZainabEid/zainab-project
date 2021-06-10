{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'id' => 'update-user-form', 'data-url' => route('admin.users.update', $user->id), 'data-user-id' => $user->id , 'role' => 'form', 'files' => true, 'method' => 'post']) !!}

@include('admin.dashboard.users._user_form')

<div class="modal-footer">
    {{-- <a href="#" class="close cancel-form btn btn-danger" data-dismiss="modal">cancel</a> --}}
    {!! Form::button('cancel', ['class' => 'btn btn-danger cancel', 'data-dismiss' => 'modal']) !!}
    {!! Form::button('update user', ['class' => 'btn btn-success update-record']) !!}

</div>
{!! Form::close() !!}
