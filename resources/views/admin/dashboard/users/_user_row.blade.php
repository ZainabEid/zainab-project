<tr id="user{{ $user->id }}">
    <td class="table-index"><span>{{ isset($table_index) ? $table_index + 1 : '' }}.</span></td>
    <td class="name">{{ $user->name ?? '' }}</td>
    <td class="email"> {{ $user->email ?? '' }}</td>
    <td class="password">{{ $user->password ?? '' }}</td>
    <td class="phone">
        @foreach ($user->user_phones as $index => $phone)
            <div id="user[{{ $user->id }}]phone[{{ $index }}]">

                {{ $index > 0 ? ',' : '' }}{{ $phone }}

            </div>
        @endforeach
    </td>
    
    <td class="photo">
        <img src="{{ get_image('users', $user->photo) }}" alt="{{ $user->name . '-image' }}" class=" img-thumbnail"
            style="height: 50px; width:50px;">

    </td>

    <td>
        <div class="row d-flex justify-content-around">
            {{-- delete user --}}
            {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'data-url' => route('admin.users.destroy', $user->id), 'method' => 'delete', 'class' => 'remove-user-btn']) !!}
            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger  btn-sm']) !!}
            {!! Form::close() !!}

            {{-- edit  user --}}
            <button type="button" class="btn btn-info edit-user" data-toggle="modal" data-target="#popup-modal"
                data-url="{{ route('admin.users.edit', $user->id) }}">
                edit user
            </button>
        </div>

        <div>
        </div>
    </td>
</tr>
