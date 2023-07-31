<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_pic',
        'fname',
        'lname',
        'course',
        'year',
        'email',
        'phone',
    ];

    protected $appends = [
        'profile_pic_url',
    ];

    public function getProfilePicUrlAttribute() {
        $url = $this->profile_pic ? asset("images/student_profile_pics/" . $this->profile_pic) : 'https://static.vecteezy.com/system/resources/thumbnails/004/607/791/small/man-face-emotive-icon-smiling-male-character-in-blue-shirt-flat-illustration-isolated-on-white-happy-human-psychological-portrait-positive-emotions-user-avatar-for-app-web-design-vector.jpg';
        return $url;
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }
}
