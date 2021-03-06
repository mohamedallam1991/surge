<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';

    public function updatedEmail()
    {
        return $this->validate(['email' => 'unique:users']);
    }

    public function register()
    {
        $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
        ]);
        $user = User::create([
            'name' => $this->email,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        auth()->login($user);
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }


}
