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
