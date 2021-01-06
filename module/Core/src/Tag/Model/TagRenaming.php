<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Core\Tag\Model;

use Shlinkio\Shlink\Core\Exception\ValidationException;

use function sprintf;

final class TagRenaming
{
    private string $oldName;
    private string $newName;

    private function __construct()
    {
    }

    public static function fromNames(string $oldName, string $newName): self
    {
        $o = new self();
        $o->oldName = $oldName;
        $o->newName = $newName;

        return $o;
    }

    public static function fromArray(array $payload): self
    {
        if (! isset($payload['oldName'], $payload['newName'])) {
            throw ValidationException::fromArray([
                'oldName' => 'oldName is required',
                'newName' => 'newName is required',
            ]);
        }

        return self::fromNames($payload['oldName'], $payload['newName']);
    }

    public function oldName(): string
    {
        return $this->oldName;
    }

    public function newName(): string
    {
        return $this->newName;
    }

    public function nameChanged(): bool
    {
        return $this->oldName !== $this->newName;
    }

    public function toString(): string
    {
        return sprintf('%s to %s', $this->oldName, $this->newName);
    }

    public function toArray(): array
    {
        return [
            'oldName' => $this->oldName,
            'newName' => $this->newName,
        ];
    }
}
