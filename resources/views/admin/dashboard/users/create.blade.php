{!! Form::open(['url' => route('admin.users.store'), 'role' => 'form', 'files' => true, 'id' => 'create-user-form']) !!}

@include('admin.dashboard.users._user_form')

<div class="modal-footer">
    {{-- <a href="#" class="close cancel-form btn btn-danger" data-dismiss="modal">cancel</a> --}}
    {!! Form::button('cancel', ['class' => 'btn btn-danger cancel' , 'data-dismiss' => 'modal']) !!}
    {!! Form::button('add user', ['class' => 'btn btn-success add-user']) !!}

</div>

{!! Form::close() !!}
