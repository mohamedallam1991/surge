<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register()
    {
        $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());

        Livewire::test('auth.register')
            ->set('email', 'caleb@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertOk()
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('caleb@gmail.com')->exists());
        $this->assertEquals('caleb@gmail.com', auth()->user()->email );
    }

    /** @test */
    public function email_is_required()
    {
        $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());

        Livewire::test('auth.register')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);


            $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());
            $this->assertNull(auth()->user());
    }

    /** @test */
    public function email_has_to_be_email()
    {
        $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());

        Livewire::test('auth.register')
            ->set('email', 'caleb')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);


            $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());
            $this->assertNull(auth()->user());
    }

    /** @test */
    public function email_has_to_be_unique()
    {
        $this->assertFalse(User::whereEmail('caleb@gmail.com')->exists());

        Livewire::test('auth.register')
            ->set('email', 'caleb@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertOk()
            ->assertRedirect('/');

            $this->assertTrue(User::whereEmail('caleb@gmail.com')->exists());
            $this->assertEquals('caleb@gmail.com', auth()->user()->email );

            auth()->logout();

        Livewire::test('auth.register')
            ->set('email', 'caleb@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);


            $this->assertEquals(User::whereEmail('caleb@gmail.com')->count(), 1);
            $this->assertNull(auth()->user());
    }
}
