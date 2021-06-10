    <div class="modal-header">
        <h5 class="modal-title" id="popup-modal">{{ isset($user) ? 'Edit User' : 'Add new user' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">


        <div class="form-group">
            {!! Form::label('name', ' user name', ['class' => 'boldfont']) !!}
            {!! Form::text('name', null, ['placeholder' => ' user name', 'id' => 'name']) !!}
            <span class="text-danger" id="name_error"></span>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'user email', ['class' => 'boldfont']) !!}
            {!! Form::email('email', null, ['placeholder' => 'user email', 'id' => 'email']) !!}
            <span class="text-danger" id="email_error"></span>
        </div>


        <div class="form-group">

            {!! Form::label('password', 'user password', ['class' => 'boldfont']) !!}
            {!! Form::password('password', null, ['placeholder' => 'user password', 'id' => 'password', 'autocomplete' => 'off']) !!}
            <span class="text-danger" id="password_error"></span>
        </div>

        <div class="form-group d-flex flex-column  " id="all-phones">
            {!! Form::label('phone', 'Enter user phones', ['class' => 'boldfont']) !!}
            @if (isset($user))

                {{-- in edit existing user --}}
                @foreach ($user->phones->pluck('phone') as $index => $phone)

                    <div class="phone-validation  @error('phone.' . $index.'_error') 'has-error' @enderror">
                        @if ($index == 0)

                            {{-- the first required phone --}}
                            {!! Form::text('phone[]', $phone, ['placeholder' => 'Enter user phone', 'class' => 'phone']) !!}
                            @error('phone.' . $index.'_error')

                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror

                            <a href="#" class="btn btn-info btn-sm" id="add-phone"
                                data-url="{{ route('admin.users.addPhone') }}">
                                <i class="fa fa-plus"></i>
                            </a>

                        @else

                            {{-- show all extra phones --}}
                            @include('admin.dashboard.users._extra_phone')


                        @endif
                    </div>


                @endforeach

            @else
                <div class="phone-validation @error('phone.0_error') 'has-error' @enderror">

                    {{-- in create new user --}}
                    {!! Form::text('phone[]', null, ['placeholder' => 'Enter user phone', 'class' => 'phone']) !!}

                    @error('phone.0_error')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                   
                    <a href="#" class="btn btn-info btn-sm" id="add-phone"
                        data-url="{{ route('admin.users.addPhone') }}">
                        <i class="fa fa-plus"></i></a>

                </div>

            @endif
        </div>


        <div class="form-group">
            {!! Form::label('photo', 'Enter user photo', ['class' => 'boldfont']) !!}
            {!! Form::file('photo', ['id' => 'photo-uploader', 'class' => 'photo-uploader']) !!}
            <span class="text-danger" id="photo_error"></span>
            <img src="{{ isset($user) ? get_image('users', $user->photo) : '' }}" alt="" class=" img-thumbnail"
                id="uploaded-photo-preview" style="height: 50px; width:50px;">
        </div>



    </div>
