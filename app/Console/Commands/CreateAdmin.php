<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    // The command you will type in the terminal
    protected $signature = 'app:create-admin';
    protected $description = 'Securely create a new admin user';

    public function handle()
    {
        $this->info('--- Admin Account Setup ---');

        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');

        $password = $this->secret('Enter admin password');
        $passwordConfirm = $this->secret('Confirm admin password');

        // 1. Check for password mismatch
        if ($password !== $passwordConfirm) {
            $this->error('Whoops! Passwords do not match. Try again.');
            return; // Stops the script if they messed up
        } // <-- WE CLOSE THE BRACKET HERE!

        // 2. Check if the email is already taken
        if (User::where('email', $email)->exists()) {
            $this->error('A user with that email already exists!');
            return;
        }

        // 3. Create the admin securely
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password, // Passing plain text, letting the Model hash it!
            'role' => 'admin',
        ]);

        $this->info("Success! Admin account {$email} has been created.");
    }
}