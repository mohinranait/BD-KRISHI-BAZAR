<?php

namespace App\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Model\MembershipPackage;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','subject','mobile', 'payment_method', 'transection_id', 'package', 'expired_at'
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

    public function roles()
    {
        return $this->hasMany('App\Model\UserRole', 'user_id');
    }

    public function isAdmin()
    {

        if($this->roles()->where('role_name', 'admin')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }


    public function hasRole($role) //$role = admin, staff..
    {
        $rq = request();

        if($role == 'admin')
        {

            if($ad = $this->roles()->where('role_name', $role)->first())
            {
                $permissions = $ad->permission;

                if(!$permissions)
                {
                    return true;
                }

                if($permissions and ($permissions == 'all'))
                {
                    return true;
                }

                if($permissions)
                {
                    $sg2 = $rq->segment(2);
                    $sg3 = $rq->segment(3);

                    if($sg2 and $sg3)
                    {
                        if($rq->method() == 'GET')
                        {
                            $permission = $sg2 . '_' . $sg3;

                            if (preg_match("~\b". $permission ."\b~", $permissions ))
                            {
                              return true;
                            }

                            else
                            {
                              abort(401);
                            }

                        }
                        else
                        {
                            return true;
                        }

                    }
                    elseif($sg2)
                    {
                        return true;
                    }
                }
            }
            else{
                abort(401);
            }
        }

        elseif($role == 'company')
        {
            return (bool) $this->companies()->count();
        }
    }

    public function adminRoleWithName()
    {
        if($r = $this->roles()->where('role_name', 'admin')->first())
        {
            return $r->role_value;
        }
        else{
            return false;
        }
    }


    public function companies()
    {
        return $this->hasMany('App\Model\Company', 'user_id');
    }

    public function hasCompanyRole()
    {
        return (bool) $this->companies()->count();
    }

    public function activeCompanies()
    {
        return $this->companies()->where('status', 'active')->orderBy('title')->get();
    }

    public function hasCompanyOf($company)
    {
         return (bool) $this->companies()
        ->whereId($company->id)
        ->whereStatus('active')
        ->first();
    }

    public function mobileOrEmail()
    {
        return $this->mobile ?: $this->email;
    }


    public function userSubject()
    {
        return $this->hasMany('App\Model\UserSubject', 'user_id');
    }


    public function isValidate()
    {
        if ($this->expired_at) {
            if (date('Y-m-d', strtotime(Carbon::parse($this->expired_at)->addDays()))  >= date('Y-m-d', strtotime(Carbon::now()))) {
                return true;
            }
        }
        return false;
    }


    // public function pendingPackage()
    // {
    //     return $this->hasMany('App\Model\MembershipPackage', 'user_id');
    // }


    public function userPackage()
    {
       $package=MembershipPackage::where('id', $this->package)->first();
       return $package;
    }

    // public function userPackageActive()
    // {
    //     return $this->userPackage()->where('id', $this->package);
    // }


    public function pendingPackage()
    {
        $pendinPackage=UserPayment::where('user_id', $this->id)->where('status', "pending")->get();
        return $pendinPackage;

    }





}
