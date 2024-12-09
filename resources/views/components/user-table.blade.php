<div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-warning">
            <tr>
                @foreach (['Id', 'Username', 'Name', 'Email', 'Phone Number', 'Gender', 'Date of Birth', 'Role', 'isDeleted', 'Action'] as $th)
                    <th style="min-width: 10vw">{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->date_of_birth }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->deleted_at ? 'YES' : 'NO' }}</td>
                    <td>
                        @if ($user->deleted_at)
                            <div class="d-flex flex-column gap-2 px-3">
                                {{-- Button to restore user --}}
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-restore-{{ $user->id }}">
                                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                                </button>

                                {{-- Restore User Modal --}}
                                <div class="modal fade" id="modal-restore-{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modalLabel-restore-{{ $user->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content text-start">
                                            <form action="{{ route('admin-restore-user.action', ['user' => $user]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="modalLabel-restore-{{ $user->id }}">User Restore
                                                        Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    User with ID {{ $user->id }} will be restored. Are you sure?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Restore</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column gap-2 px-3">
                                {{-- Button to delete user --}}
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-{{ $user->id }}">
                                    <i class="fa-solid fa-trash" style="color: white"></i>
                                </button>

                                {{-- Delete User Modal --}}
                                <div class="modal fade" id="modal-delete-{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modalLabel-delete-{{ $user->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content text-start">
                                            <form action="{{ route('admin-delete-user.action', ['user' => $user]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel-delete-{{ $user->id }}">
                                                        User Deletion Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    User with ID {{ $user->id }} will be permanently deleted. Are
                                                    you sure?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No User</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $users->links() }}
</div>
