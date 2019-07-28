<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientUser extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clientuser';


    /*
                + Options
                Full texts	
                id
                first_name
                last_name
                phone
                label
                created_at
                updated_at
                deleted_at

                Edit Edit
                Copy Copy
                Delete Delete
                1
                Mahesh
                Prasad
                8860409946
                mpd
                2019-07-27 11:36:14
                2019-07-27 11:36:14
                NULL

    */


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'label'
    ];


    use SoftDeletes;


}
