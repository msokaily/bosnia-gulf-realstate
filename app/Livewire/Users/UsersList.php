<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class UsersList extends Component
{

    use WithPagination;

    protected $listeners = ['update_user_list' => 'render'];

    protected $paginationTheme = 'bootstrap';

    // #[Url]
    public $search = '';

    public $bulk_users = [];

    public $pageItems = 9;

    private $users_result = [];

    public $isChecked = false;

    public function searchUsers()
    {
        $this->reset('bulk_users');
        $this->reset('isChecked');
        $this->render();
    }

    public function openUser($id)
    {
        $this->dispatch('editUser', $id);
    }

    public function select_user($id, $isChecked)
    {
        if ($isChecked) {
            $this->bulk_users[$id] = true;
        }else {
            unset($this->bulk_users[$id]);
        }
    }
    public function select_bulk($isChecked)
    {
        $ids = [];
        $users = $this->getUsers();
        if ($isChecked) {
            foreach($users as $key => $value) {
                $ids[$value->id] = true;
            }
        }else {
            $ids = [];
        }
        $this->bulk_users = $ids;
    }

    private function getUsers()
    {
        if ($this->search) {
            $users = User::where('role', 'User')->where(function ($q) {
                $q->where('first_name', 'LIKE', '%' . $this->search . '%');
                $q->orWhere('last_name', 'LIKE', '%' . $this->search . '%');
                $q->orWhere('email', 'LIKE', '%' . $this->search . '%');
                $q->orWhere('oib', 'LIKE', '%' . $this->search . '%');
            })->paginate($this->pageItems);
        } else {
            $users = User::where('role', 'User')->paginate($this->pageItems);
        }
        return $users;
    }

    public function delete_selected()
    {
        $ids = array_keys($this->bulk_users);
        User::whereIn('id', $ids)->delete();
        $this->searchUsers();
    }

    public function verify_selected()
    {
        $ids = array_keys($this->bulk_users);
        User::whereIn('id', $ids)->update(['verified_at' => Carbon::now()]);
        $this->searchUsers();
    }

    public function render()
    {
        $data['users'] = $this->getUsers();
        return view('livewire.users.users-list', $data);
    }
}
