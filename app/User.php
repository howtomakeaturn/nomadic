<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Config;

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

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function recommendations()
    {
        return $this->hasMany('App\Recommendation');
    }

    public function wishes()
    {
        return $this->hasMany('App\Wish');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function entityTags()
    {
        return $this->hasMany('App\EntityTag');
    }

    public function editings()
    {
        return $this->hasMany('App\Editing');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    function validPhotos()
    {
        return $this->photos->filter(function($p){
            return $p->status >= 0;
        });
    }

    public function entities()
    {
        return $this->hasMany('App\Entity');
    }

    public function socialCredentials()
    {
        return $this->hasMany('App\SocialCredential');
    }

    function getScore()
    {
        $score = 0;

        $score += $this->recommendations->count() * 2;

        $score += ( $this->comments->count() * 5 );

        $score += ( $this->reviews->count() * 5 );

        $score += ( $this->editings->count() * 5 );

        $score += ( $this->entities->count() * 5 );

        $score += ( $this->validPhotos()->count() * 5 );

        $score += ( $this->entityTags->count() * 1 );

        return $score;
    }

    function isAdmin()
    {
        return in_array($this->email, Config::get('admin.users'));
    }

    function presentPointPhoto()
    {
        return view( '_point-photo', [ 'avatar' => $this->profile->avatar, 'point' => $this->getScore() ] );
    }

    function hasWish($cafe)
    {
        return Wish::where('cafe_id', $cafe->id)->where('user_id', $this->id)->count();
    }

}
