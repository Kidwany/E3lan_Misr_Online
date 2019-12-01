<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Mail;
use Auth;

class User extends Model implements AuthenticatableContract  {

    use Authenticatable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'role_id', 'email_verified_at', 'password', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['email_verified_at'];


    public function sendActivationMail(){
        
        $data = ['user'=>$this];

        Mail::send(['html' => 'email.welcomeEmail'], $data, function ($message) {
            $message
                ->to($this->email, $this->name)
                ->subject('E3lan Misr activation mail');
            $message
                ->from('hs-test@pbc-egy.com','H&S');

        });

    }


}
