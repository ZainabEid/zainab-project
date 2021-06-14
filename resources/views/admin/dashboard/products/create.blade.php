{!! Form::open(['url' => route('admin.products.store'), 'role' => 'form', 'files' => true]) !!}

{{-- @include('admin.dashboard.products._product_form') --}}

<div class="modal-footer">
    {{-- <a href="#" class="close cancel-form btn btn-danger" data-dismiss="modal">cancel</a> --}}
    {!! Form::button('cancel', ['class' => 'btn btn-danger cancel' , 'data-dismiss' => 'modal']) !!}
    {!! Form::button('add product', ['class' => 'btn btn-success add-product']) !!}

</div>

{!! Form::close() !!}
