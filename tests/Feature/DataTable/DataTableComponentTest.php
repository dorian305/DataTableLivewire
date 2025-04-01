<?php

namespace Tests\Feature\DataTable;

use App\Livewire\RegisterUserForm;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class DataTableComponentTest extends TestCase
{
    use DatabaseTransactions;

    private function getTestUserData(): array
    {
        return [
            [
                'firstName' => 'Johna',
                'lastName' => 'Bohna',
                'email'    => 'email1@email.com',
                'profilePhoto' => null,
                'password' => 'secret123',
                'confirmPassword' => 'secret123',
            ],
            [
                'firstName' => 'Klona',
                'lastName' => 'Brez slona',
                'email'    => 'email2@email.com',
                'profilePhoto' => null,
                'password' => 'secret123',
                'confirmPassword' => 'secret123',
            ],
        ];
    }

    private function tryCreatingUser(array $userData, bool $expectErrors): void
    {
        $test = Livewire::test(RegisterUserForm::class)
            ->set('firstName', $userData['firstName'])
            ->set('lastName', $userData['lastName'])
            ->set('email', $userData['email'])
            ->set('profilePhoto', $userData['profilePhoto'])
            ->set('password', $userData['password'])
            ->set('confirmPassword', $userData['confirmPassword'])
            ->call('createUser');

        if ($expectErrors) {
            $test->assertHasErrors();
        } else {
            $test->assertHasNoErrors();
        }
    }

    public function test_can_create_new_user(): void
    {
        $userData = $this->getTestUserData()[0];

        $this->tryCreatingUser($userData, false);
        $this->assertDatabaseHas('users', [
            'name' => "{$userData['firstName']} {$userData['lastName']}",
            'email' => $userData['email'],
        ]);
    }

    public function test_duplicate_email_not_allowed(): void
    {
        $userData1 = $this->getTestUserData()[0];
        $userData2 = $this->getTestUserData()[1];
        $userData2['email'] = $userData1['email'];

        $this->tryCreatingUser($userData1, false);
        $this->tryCreatingUser($userData2, true);
    }

    public function test_user_profile_photo_is_uploaded_on_creation(): void
    {
        $userData = $this->getTestUserData()[0];
        $profilePhoto = UploadedFile::fake()->image('profile_photo.png');
        $userData['profilePhoto'] = $profilePhoto;

        $this->tryCreatingUser($userData, false);

        $user = User::where('email', '=', $userData['email'])->first();

        $this->assertNotNull($user->profile_photo_path, "Profile photo path was not set properly.");
        Storage::disk('public')->assertExists($user->profile_photo_path);

        // Cleanup: delete the uploaded profile photo
        Storage::disk('public')->delete($user->profile_photo_path);
    }
}