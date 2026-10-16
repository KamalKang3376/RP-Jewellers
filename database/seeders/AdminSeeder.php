
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $name = env('ADMIN_NAME');
        $password = env('ADMIN_PASSWORD');

        if (!$email || !$name || !$password) {
            throw new RuntimeException(
                'ADMIN_EMAIL, ADMIN_NAME and ADMIN_PASSWORD must be configured.'
            );
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}
