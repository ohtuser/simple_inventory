<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'mobile',
        'address',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function storeOrUpdate($request)
    {
        $data = [
            'user_type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address
        ];
        // dd($request);
        if ($request->row_id) {
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            User::find($request->row_id)->update($data);
        } else {
            $data['password'] = Hash::make($request->password);
            User::create($data);
        }
        return true;
    }

    public function getInvoice()
    {
        return $this->hasMany(Invoice::class, 'party_id');
    }

    public function getProfileUpdateRequest(){
        return $this->hasOne(CustomerProfileUpdateRequest::class, 'user_id');
    }
}
