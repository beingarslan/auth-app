<div>
    <!-- search box -->
    <form class="form" wire:submit.prevent="filterUserList">
        <div class="form-group mt-2">
            <div class="input-group">
                <input type="text" class="form-control" wire:model='search' placeholder="Search" wire:model="search">
            </div>
        </div>
    </form>
    <!-- search box end -->

    <!-- loading -->
    <div wire:loading>
        Loading...
    </div>
    <!-- loading end -->

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <!-- pagination links on right -->
    <div class="d-flex justify-content-end">
        {{ $users->links() }}
    </div>
</div>