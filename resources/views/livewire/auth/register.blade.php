@extends('layouts.app')

@section('content')
    <div>



        <form action="/register" method="POST">

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </div>

        <div>
            <label for="password">Password </label>
            <input type="text" id="password" name="password">
        </div>

        <div>
            <label for="passwordConfirmation">Password Confirmation</label>
            <input type="text" id="passwordConfirmation" name="passwordConfirmation">
        </div>

        <div>
            <input type="submit" value="Register">
        </div>

        </form>



    </div>
@endsection
