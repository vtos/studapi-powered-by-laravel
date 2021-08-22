<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final class StudentName
{
    private string $firstName;

    private string $lastName;

    private string $secondName;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $secondName
     */
    private function __construct(
        string $firstName,
        string $lastName,
        string $secondName
    ) {
        Assert::notEmpty($firstName, 'Student first name cannot be empty.');
        Assert::notWhitespaceOnly($firstName, 'Student first name cannot be empty.');

        Assert::notEmpty($lastName, 'Student last name cannot be empty.');
        Assert::notWhitespaceOnly($lastName, 'Student last name cannot be empty.');

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->secondName = $secondName;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function secondName(): string
    {
        return $this->secondName;
    }

    public function asString(): string
    {
        $parts = [
            $this->lastName,
            $this->firstName,
        ];
        if (!empty($this->secondName)) {
            $parts[] = $this->secondName;
        }

        return implode(' ', $parts);
    }

    public static function fromStrings(string $firstName, string $lastName, string $secondName): self
    {
        return new self($firstName, $lastName, $secondName);
    }

    public static function fromStringsWithNoSecondName(string $firstName, string $lastName): self
    {
        return new self($firstName, $lastName, '');
    }
}
