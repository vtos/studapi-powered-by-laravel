<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Student;

trait TruncateCollection
{
    public function truncateCollection(): void
    {
        $this->beforeApplicationDestroyed(function () {
            Student::truncate();
        });
    }
}
