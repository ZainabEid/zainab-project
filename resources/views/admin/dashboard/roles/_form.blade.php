 <div class="card-body">
     <div class="form-group">

         {!! Form::label('name', 'Role Name:', ['class' => 'boldfont']) !!}
         {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter the role name', 'required' => 'required']) !!}

     </div>

     {{-- permision assignment --}}
     <div>

         {{-- nav tabs --}}
         <ul class="nav nav-tabs" role="tablist">

             @foreach (get_models() as $index => $model)
                 <li class="nav-item">
                     <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab"
                         href="#{{ $model }}" role="tab" aria-selected="true">@lang('site.'.$model)</a>
                 </li>
             @endforeach

         </ul>

         {{-- tab content --}}
         <div class="tab-content">

             @foreach (get_models() as $index => $model)
                 <div id="{{ $model }}" class="tab-pane {{ $index == 0 ? 'active' : '' }}" role="tabpanel">

                    @foreach (crud_maps() as $map)

                        <div class="form-check">

                        {!! Form::checkbox('permissions[]' , $map.'_'.$model, null, ['class' =>"form-check-input"]) !!}
                        {!! Form::label('checkbox', $map.' '.$model, ['class' => 'form-check-label']) !!}

                        </div>

                    @endforeach

                 </div>
             @endforeach

         </div>
         {{-- end of tab content --}}

     </div>
     {{-- End of permision assignment --}}



     <div class="card-footer">
         {!! Form::submit('save', ['class' => 'btn btn-success']) !!}
     </div>


 </div>
