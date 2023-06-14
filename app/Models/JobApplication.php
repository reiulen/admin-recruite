<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter)
    {
        $query->when($filter->name ?? false, function ($query, $name) {
            $query->where('name', 'like', "%{$name}%");
        })->when($filter->email ?? false, function ($query, $email) {
            $query->where('email', 'like', "%{$email}%");
        })->when($filter->phone ?? false, function ($query, $phone) {
            $query->where('phone', $phone);
        })->when($filter->hear_about_us ?? false, function ($query, $hear_about_us) {
            $query->where('hear_about_us', $hear_about_us);
        })->when($filter->submitted_at ?? false, function ($query, $submitted_at) {
            $query->whereDate('created_at', date('Y-m-d', strtotime($submitted_at)));
        });
    }

}
