<?php

namespace App\Modules\Authentication\Services;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

    public function all(): Collection
    {
        return User::all();
    }

    public function getById(Int $id): User
    {
        return User::findOrFail($id);
    }

    public function getByEmail(String $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, User $user): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $data): bool|null
    {
        return $data->delete();
    }

}
