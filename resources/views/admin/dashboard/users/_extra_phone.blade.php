<div class="extra-phones">

    {!! Form::text('phone[]', $phone ?? null, ['placeholder' => 'Enter extra phone', 'class' => 'phone[]']) !!}

    @isset($index)
        @error('phone.' . $index)

            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror

    @endisset
    <a href="#" class="cancelPhone btn btn-danger btn-xs"> x </a>
</div>
