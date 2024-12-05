<div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-warning">
            <tr>
                @foreach (['Id', 'Username', 'Name', 'Email', 'Phone Number', 'Gender', 'DOB', 'Role'] as $th)
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
