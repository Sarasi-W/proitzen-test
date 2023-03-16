<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'hire_date',
        'birth_date'
    ];

    protected $dates = [
        'hire_date',
        'birth_date',
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'emp_no', 'id');
    }

    public function titles()
    {
        return $this->hasMany(Title::class, 'emp_no', 'id');
    }
}