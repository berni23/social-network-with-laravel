<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;
use arrayTools;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function relationships()
    {
        $rel1 = $this->hasMany(relationship::class, 'user_one_id')->get();
        $rel2 = $this->hasMany(relationship::class, 'user_two_id')->get();
        return  arrayTools::merge($rel1, $rel2);
    }
    public function RelationshipsByStatus(int $status)
    {
        $rels = $this->relationships();
        $relsByStatus = [];
        foreach ($rels as $rel) {
            if ($rel['status'] == $status) array_push($relsByStatus, $rel);
        }
        return $relsByStatus;
    }

    public function friendsId()
    {
        $userId = $this->getKey();
        $accepted = $this->RelationshipsByStatus(1);
        $idList = [];
        foreach ($accepted as $rel) {
            if ($rel['user_one_id'] == $userId) array_push($idList, $rel['user_one_id']);
            else  array_push($idList, $rel['user_two_id']);
        }
        return $idList;
    }
}
