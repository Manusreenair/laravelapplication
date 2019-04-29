<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    public function EventAdmins()
    {
        return $this->hasMany('App\Event','users_id','id');
    }
    public function showlogins()
    {
        $user=User::where('id',$this->id);
        $user->update(['status'=>'1']);
    }
    public function userRelatedEvents()
    {
        if(isSuperAdmin())
            return Event::get();
        $user=User::with('EventAdmins')->where('id',$this->id)->first();
        $events=[];
        foreach($user->EventAdmins as $admin)
        {
            if($admin!=null)
            {
                array_push($events,$admin);
            }
        }
        return collect($events);
    }
    
    
}
