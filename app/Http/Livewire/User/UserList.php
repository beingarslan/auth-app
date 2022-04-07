<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class UserList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = ['removeUser' => 'removeUser'];

    public function validateData($id)
    {
        // dd($id);
        $this->dispatchBrowserEvent(
            'swal:confirm',
            [
                'type' => 'warning',
                'message' => 'Are you sure?',
                'text' => 'If deleted, you will not be able to recover this account!',
                'method_name' => 'removeUser',
                'method_params' => [$id]
            ]
        );
    }

    public function removeUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'User has been removed!'
            ]
        );
    }

    public function filterUserList()
    {
        $this->resetPage();

        $users  = User::query();

        if ($this->search) {
            $users->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        return $users->paginate(10);
    }

    public function render()
    {
        $data = [
            'users' => $this->filterUserList(),
        ];
        return view('livewire.user.user-list', $data);
    }
}
