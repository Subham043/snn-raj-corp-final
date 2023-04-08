<?php

namespace App\Modules\User\Services;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class UserService
{

    public function all(): Collection
    {
        return User::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = User::with('roles');
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): User
    {
        return User::with('roles')->findOrFail($id);
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

    public function assignRole(String $role, User $user): void
    {
        $user->assignRole($role);
    }

    public function removeRole(User $user): void
    {
        $user->syncRoles([]);
    }

    public function delete(User $data): bool|null
    {
        return $data->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
