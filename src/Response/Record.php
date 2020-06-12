<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DateTimeImmutable;

abstract class Record
{
    /**
     * Technický identifikátor riadku vygenerovaný automaticky v MODe.
     *
     * @var int|null
     */
    protected $id;

    /**
     * Identifikátor zmeny.
     *
     * @var int|null
     */
    protected $changeId;

    /**
     * Dátumčas vykonania zmeny v referenčnom systéme (t.j. Register Adries).
     *
     * @var DateTimeImmutable|null
     */
    protected $changedAt;

    /**
     * Vykonaná databázová operácia.
     *
     * @var string|null
     */
    protected $databaseOperation;

    /**
     * Identifikátor objektu.
     *
     * @var int|null
     */
    protected $objectId;

    /**
     * Identifikátor verzie záznamu.
     *
     * @var int|null
     */
    protected $versionId;

    /**
     * Dôvod vytvorenia záznamu.
     *
     * @var string|null
     */
    protected $createdReason;

    /**
     * Dátum a čas platnosti od.
     *
     * @var DateTimeImmutable|null
     */
    protected $validFrom;

    /**
     * Dátum a čas platnosti do.
     *
     * @var DateTimeImmutable|null
     */
    protected $validTo;

    /**
     * Dátum účinnosti.
     *
     * @var DateTimeImmutable|null
     */
    protected $effectiveDate;

    /**
     * Identifikátor číselníka.
     *
     * @var string|null
     */
    protected $codelistCode;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        $this->id = $this->intOrNull($record['_id'] ?? null);
        $this->changeId = $this->intOrNull($record['changeId'] ?? null);
        $this->changedAt = $this->dateTimeOrNull($record['changedAt'] ?? null);
        $this->databaseOperation = $this->stringOrNull($record['databaseOperation'] ?? null);
        $this->objectId = $this->intOrNull($record['objectId'] ?? null);
        $this->versionId = $this->intOrNull($record['versionId'] ?? null);
        $this->createdReason = $this->stringOrNull($record['createdReason'] ?? null);
        $this->validFrom = $this->dateTimeOrNull($record['validFrom'] ?? null);
        $this->validTo = $this->dateTimeOrNull($record['validTo'] ?? null);
        $this->effectiveDate = $this->dateTimeOrNull($record['effectiveDate'] ?? null);
        $this->codelistCode = $this->stringOrNull($record['codelistCode'] ?? null);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getChangeId(): ?int
    {
        return $this->changeId;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getChangedAt(): ?DateTimeImmutable
    {
        return $this->changedAt;
    }

    /**
     * @return string|null
     */
    public function getDatabaseOperation(): ?string
    {
        return $this->databaseOperation;
    }

    /**
     * @return int|null
     */
    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /**
     * @return int|null
     */
    public function getVersionId(): ?int
    {
        return $this->versionId;
    }

    /**
     * @return string|null
     */
    public function getCreatedReason(): ?string
    {
        return $this->createdReason;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getValidFrom(): ?DateTimeImmutable
    {
        return $this->validFrom;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getValidTo(): ?DateTimeImmutable
    {
        return $this->validTo;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEffectiveDate(): ?DateTimeImmutable
    {
        return $this->effectiveDate;
    }

    /**
     * @return string|null
     */
    public function getCodelistCode(): ?string
    {
        return $this->codelistCode;
    }

    /**
     * @param mixed $value
     */
    protected function stringOrNull($value): ?string
    {
        return $value === null ? null : (string) $value;
    }

    /**
     * @param mixed $value
     */
    protected function boolOrNull($value): ?bool
    {
        return $value === null ? null : (bool) $value;
    }

    /**
     * @param mixed $value
     */
    protected function intOrNull($value): ?int
    {
        return $value === null ? null : (int) $value;
    }

    /**
     * @param mixed $value
     */
    protected function dateTimeOrNull($value): ?DateTimeImmutable
    {
        return $value === null ? null : new DateTimeImmutable($value);
    }

    /**
     * @param mixed $value
     *
     * @return array<int>
     */
    protected function intArrayOrNull($value): ?array
    {
        if (is_string($value)) {
            $value = explode(',', $value);
        }

        if (is_scalar($value)) {
            $value = [$value];
        }

        if (is_array($value)) {
            return array_map('intval', $value);
        }

        return null;
    }
}
