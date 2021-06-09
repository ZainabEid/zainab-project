 
 <div class="card-body">
        <div class="form-group">

          
          {!! Form::label('ar_name', 'Arabic Name:', array('class' => 'boldfont')) !!}
          {!! Form::text('ar_name',null,['class'=>'form-control', 'placeholder'=>'Enter name in Arabic', 'required' => 'required']) !!}

        </div>

        <div class="form-group">
        
          {!! Form::label('en_name', 'English Name:', array('class' => 'boldfont')) !!}
          {!! Form::text('en_name',null,['class'=>'form-control', 'placeholder'=>'Enter name in English', 'required' => 'required']) !!}
          
        </div>
      
        <div class="form-group">
        
          {!! Form::label('photo', 'Photo:', array('class' => 'boldfont')) !!}
          {!! Form::file('photo') !!}
        </div>


        <div class="card-footer">
         {!! Form::submit('save',['class'=>'btn btn-success']) !!}
        </div>


      </div>