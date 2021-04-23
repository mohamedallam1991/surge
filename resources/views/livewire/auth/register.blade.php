
    <div>


        <form wire:submit.prevent="register">
        {{ $email }}

        <div>
            <label for="email">Email</label>
            <input wire:model="email" type="text" id="email" name="email">
        </div>

        <div>
            <label for="password">Password </label>
            <input wire:model="password" type="password" id="password" name="password">
        </div>

        <div>
            <label for="passwordConfirmation">Password Confirmation</label>
            <input wire:model="passwordConfirmation" type="password" id="passwordConfirmation" name="passwordConfirmation">
        </div>

        <div>
            <input type="submit" value="Register">
        </div>

        </form>



    </div>
