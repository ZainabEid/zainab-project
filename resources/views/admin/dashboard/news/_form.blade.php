 
 <div class="card-body">
        <div class="form-group">

          
          {!! Form::label('title_ar', 'Arabic Title:', array('class' => 'boldfont')) !!}
          {!! Form::text('title_ar',null,['class'=>'form-control', 'placeholder'=>'Enter Title in Arabic', 'required' => 'required']) !!}

        </div>

        <div class="form-group">
        
          {!! Form::label('title_en', 'English Title:', array('class' => 'boldfont')) !!}
          {!! Form::text('title_en',null,['class'=>'form-control', 'placeholder'=>'Enter Title in English', 'required' => 'required']) !!}
          
        </div>

        <div class="form-group">
        
          {!! Form::label('description', 'Description:', array('class' => 'boldfont')) !!}
          {!! Form::text('description',null,['class'=>'form-control', 'placeholder'=>'Enter description', 'required' => 'required']) !!}
          
        </div>
      
        <div class="form-group">
        
          {!! Form::label('photo', 'Photo:', array('class' => 'boldfont')) !!}
          {!! Form::file('photo') !!}
        </div>


        <div class="card-footer">
         {!! Form::submit('save',['class'=>'btn btn-success']) !!}
        </div>


      </div>