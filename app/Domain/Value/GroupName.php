<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final class GroupName
{
    private string $groupName;

    /**
     * @param string $groupName
     */
    private function __construct(string $groupName)
    {
        Assert::notEmpty($groupName, 'Student group name cannot be empty.');
        Assert::notWhitespaceOnly($groupName, 'Student group name cannot be empty.');

        $this->groupName = $groupName;
    }

    public function asString(): string
    {
        return $this->groupName;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }
}
