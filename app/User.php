<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function memberships(){
        return $this->hasMany(Membership::class);
    }

    public function have_membership(){
        $status = $this->memberships()->latest()->first();
        if($status){
            return true;
        }
            return false;
    }

    public function last_day_of_last_membership(){
        $membership = $this->memberships()->latest()->first();
        return $membership->last_day;
    }

    public function remaining_days_of_membership(){
        //Si no tiene membresias anteriores 
        if(!$this->have_membership()){
            return 0;
        }

        //Si ya tiene membresias verificio la diferencia de dias con la fecha actual de su ultima membresia
        $date_membership = Carbon::parse($this->last_day_of_last_membership(), 'America/Guatemala')->addDay()->startOfDay();
        $current_date = Carbon::now('America/Guatemala')->startOfDay();

        $remaining_days = $date_membership->diffInDays($current_date);

        return $remaining_days;

    }

    public function is_premium(){
        return $this->remaining_days_of_membership() > 0;
    }

    public function premium_until(){
        setlocale(LC_TIME, 'Spanish');
        $date_membership = Carbon::parse($this->last_day_of_last_membership(), 'America/Guatemala')->startOfDay();
        return $date_membership->format('d/m/Y');         
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
