@extends('Layout.Layoutt')
@section('content')
    <div class="card-body" id="users">



        <table>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($users as $user)
                <tr>
                    <th>username</th>
                    <th>email</th>
                </tr>

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        <dialog id="dialog-{{ $user->id }}" class="edit-user-dialog">
                            <p>Edit</p>
                            <form method="POST" action="{{ url("admin/user/{$user->id}/edit") }}">
                                @method('PUT')
                                @csrf
                                <div class="mb">
                                    <label for="name-{{ $user->id }}">username</label>
                                    <input type="text" id="name-{{ $user->id }}" name="name"
                                        value ="{{ $user->name }}" />
                                </div>

                                <div class="mb">
                                    <label for="email-{{ $user->id }}">Email</label>
                                    <input type="text" name="email" id="email-{{ $user->id }}"
                                        value="{{ $user->email }}" />
                                </div>

                                <div class="mb">
                                    <label for="is_active-{{ $user->id }}">Active</label>
                                    <select name="is_active" id="is_active-{{ $user->id }}">
                                        <option {{ !$user->is_active ? 'selected' : '' }} value="0">No</option>
                                        <option {{ $user->is_active ? 'selected' : '' }} value="1">Yes</option>
                                    </select>
                                </div>

                                <button>Submit</button>
                            </form>
                        </dialog>
                        <button class="edit-user" id="edit-{{ $user->id }}">Edit</button>
                    </td>

                    <td>
                        <form action="{{ url("admin/user/$user->id/delete") }}" method="POST">
                            @csrf
                            @method('delete')
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        const users = document.getElementById("users");
        // "Show the dialog" button opens the dialog modally
        users.addEventListener("click", (e) => {
            const target = e.target;
            if (!target.classList.contains('edit-user')) {
                return;
            }


            const id = target.id.replace('edit-', '');
            document.getElementById('dialog-' + id).showModal();
        });

        // // "Close" button closes the dialog
        // closeButton.addEventListener("click", () => {
        //     dialog.close();
        // });
    </script>
@endsection
