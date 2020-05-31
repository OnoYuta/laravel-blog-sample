<?php

namespace App\Models\LaravelAdmin;

use Encore\Admin\Auth\Database\Administrator as Authenticatable;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Administrator extends Authenticatable implements AuthenticatableContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // /**
    //  * Save the model to the database.
    //  *
    //  * @param  array  $options
    //  * @return bool
    //  */
    // public function save(array $options = [])
    // {
    //     $query = $this->newModelQuery();

    //     // If the "saving" event returns false we'll bail out of the save and return
    //     // false, indicating that the save failed. This provides a chance for any
    //     // listeners to cancel save operations if validations fail or whatever.
    //     if ($this->fireModelEvent('saving') === false) {
    //         return false;
    //     }

    //     // If the model already exists in the database we can just update our record
    //     // that is already in this database using the current IDs in this "where"
    //     // clause to only update this model. Otherwise, we'll just insert them.
    //     if ($this->exists) {
    //         $saved = $this->isDirty() ?
    //             $this->performUpdate($query) : true;
    //     }

    //     // If the model is brand new, we'll insert it into our database and set the
    //     // ID attribute on the model to the value of the newly inserted row's ID
    //     // which is typically an auto-increment value managed by the database.
    //     else {
    //         $saved = $this->performInsert($query);

    //         if (
    //             !$this->getConnectionName() &&
    //             $connection = $query->getConnection()
    //         ) {
    //             $this->setConnection($connection->getName());
    //         }
    //     }

    //     // If the model is successfully saved, we need to do a few more things once
    //     // that is done. We will call the "saved" method here to run any actions
    //     // we need to happen after a model gets successfully saved right here.
    //     if ($saved) {
    //         $this->finishSave($options);
    //     }

    //     $this->roles()->save(Role::first());;

    //     return $saved;
    // }
}
