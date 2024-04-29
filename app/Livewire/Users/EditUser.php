<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{

    protected $listeners = ['editUser'];
    
    public $id;

    public $mode = '';

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $mobile = '';
    public $status = true;
    public $oib = '';
    public $password = '';
    public $address = '';
    public $verified_at = false;

    public function mount($id = null, $mode = '') {
        if ($id) {
            $this->mode = 'edit';
            $this->id = $id;
            $user = User::find($this->id);
            if ($user) {
                $this->first_name = $user->first_name;
                $this->last_name = $user->last_name;
                $this->email = $user->email;
                $this->mobile = $user->mobile;
                $this->status = $user->status == 'Active' ? true : false;
                $this->oib = $user->oib;
                $this->address = $user->address;
                $this->verified_at = $user->verified_at ? true : false;
            }else {
                $this->redirect(route('admin.users.index'), true);
            }
        }else {
            $this->mode = $mode ?? '';
        }
        return true;
    }

    public function createUser()
    {
        $this->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'oib' => 'sometimes|string|max:191',
            'password' => 'required|string|max:191',
            'address' => 'sometimes|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email',
            'mobile' => 'sometimes|string|max:191|unique:users,mobile'
        ]);
        $data = $this->only(['first_name', 'last_name', 'email', 'mobile', 'status', 'address', 'password', 'oib', 'verified_at']);
        $data['role'] = 'User';
        $created = User::create($data);
        if ($created) {
            session()->flash('status', 'User successfully created');
            $this->redirect(route('admin.users.index'));
            $this->dispatch('update_user_list');
            $this->dispatch('alert_remove');
        }
    }

    public function updateUser()
    {
        $this->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'oib' => 'sometimes|string|nullable|max:191',
            'password' => 'sometimes|string|nullable|max:191',
            'address' => 'sometimes|string|nullable|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$this->id,
            'mobile' => 'sometimes|string|nullable|max:191|unique:users,mobile,'.$this->id
        ]);
        $user = User::find($this->id);
        if ($user) {
            $updated = $user->update($this->only(['first_name', 'last_name', 'email', 'mobile', 'status', 'address', 'password', 'oib', 'verified_at']));
            if ($updated) {
                session()->flash('status', 'User successfully updated.');
                $this->dispatch('update_user_list');
                $this->dispatch('alert_remove');
            }
        }else {
            session()->flash('errors', ['We can\'t find the user!']);
        }
    }
    
    public function render()
    {
        if ($this->id) {
            $data['item'] = User::find($this->id);
        }else {
            $data['item'] = null;
        }
        return view('livewire.users.edit-user', $data);
    }
}
