<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KerjaSama;
use Illuminate\Auth\Access\HandlesAuthorization;

class KerjaSamaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_kerja::sama');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('view_kerja::sama');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_kerja::sama');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('update_kerja::sama');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('delete_kerja::sama');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_kerja::sama');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('force_delete_kerja::sama');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_kerja::sama');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('restore_kerja::sama');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_kerja::sama');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, KerjaSama $kerjaSama): bool
    {
        return $user->can('replicate_kerja::sama');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_kerja::sama');
    }
}
