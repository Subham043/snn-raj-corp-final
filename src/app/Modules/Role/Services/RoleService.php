<?php

namespace App\Modules\Role\Services;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;

class RoleService
{

    public function all(): Collection
    {
        return Role::all();
    }

    public function paginate(Int $total = 10): Collection
    {
        return QueryBuilder::for(Role::class)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total);
    }

    public function getById(Int $id): Role
    {
        return Role::findOrFail($id);
    }

    public function create(array $data): Role
    {
        return Role::create($data);
    }

    public function update(array $data, Role $role): Role
    {
        $role->update($data);
        return $role;
    }

    public function delete(Role $data): bool|null
    {
        return $data->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
