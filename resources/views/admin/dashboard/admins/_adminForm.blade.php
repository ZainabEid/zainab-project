 <div class="card-body">

     {{-- Name --}}
     <div class="form-group">
         {!! Form::label('name', 'Admin Name:', ['class' => 'boldfont']) !!}
         {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter admin name', 'required' => 'required']) !!}

     </div>

     {{-- Email --}}
     <div class="form-group">

         {!! Form::label('email', 'Email:', ['class' => 'boldfont']) !!}
         {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter admin email', 'required' => 'required']) !!}

     </div>

     {{-- Password --}}
     <div class="form-group">

         {!! Form::label('password', 'password:', ['class' => 'boldfont']) !!}
         {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Enter admin passwprd', 'required' => 'required']) !!}

     </div>



     {{-- permision assignment --}}

     <div class="form-group">

         {!! Form::label('roles', 'roles:', ['class' => 'boldfont']) !!}
         @foreach ($all_roles as $index=>$role)
             <div class="form-check">
                 {!! Form::checkbox('roles[]', $role,null, ['class' => 'form-check-input']) !!}
                 {!! Form::label('', $role, ['class' => 'form-check-label']) !!}

             </div>
         @endforeach

     </div>
     {{-- end of tab content --}}

     {{-- End of permision assignment --}}


     {{-- end of card-body --}}


     <div class="card-footer">
         {!! Form::submit('save', ['class' => 'btn btn-success']) !!}
     </div>


 </div>
