<?php

declare(strict_types=1);

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Casts\SIN as SINCast;
use App\Casts\StudentName as StudentNameCast;
use App\Casts\GroupName as GroupNameCast;

final class Student extends Model
{
    public $timestamps = false;

    protected $fillable = [];

    protected $casts = [
        'sin' => SINCast::class,
        'name' => StudentNameCast::class,
        'group_name' => GroupNameCast::class,
    ];
}
