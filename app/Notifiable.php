<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifiable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifiables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model', 'message', 'on'];

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setOnAttribute($value){
        $this->attributes['on'] = ! empty($value)?: false;
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
