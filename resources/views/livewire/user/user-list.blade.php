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
                    
                    <button wire:click="validateData( {{$user->id}} )" class="btn btn-danger btn-sm">Delete</button>
                    
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener('alert', function() {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "10000",
        }
    })
</script>


<script>
    document.addEventListener('swal:method', function() {
        swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
        });
    })

    document.addEventListener('swal:confirm', function() {
        var method_name = event.detail.method_name;
        var method_params = event.detail.method_params;

        swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    window.livewire.emit(method_name, method_params);
                }
            });
    })
</script>

@endpush