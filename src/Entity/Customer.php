<?php

namespace App\Entity;

use App\Enum\CurrencyEnum;
use App\Repository\CustomerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\Table(
    name: 'customer',
    indexes: [
        new ORM\Index(name: 'idx_customer_is_active', columns: ['is_active']),
        new ORM\Index(name: 'idx_customer_name', columns: ['name']),
        new ORM\Index(name: 'idx_customer_created_at', columns: ['created_at']),
    ]
)]
#[ORM\HasLifecycleCallbacks]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(mode: Assert\Email::VALIDATION_MODE_HTML5)]
    #[Assert\Length(max: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(max: 50)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url]
    #[Assert\Length(max: 255)]
    private ?string $website = null;

    #[ORM\Column(length: 32, nullable: true)]
    #[Assert\Length(max: 32)]
    private ?string $vatId = null;

    #[ORM\Column(options: ['default' => true])]
    private bool $isActive = true;

    #[ORM\Column(options: ['default' => true])]
    private bool $isBillable = true;

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $defaultHourlyRate = null;

    #[ORM\Column(enumType: CurrencyEnum::class)]
    private CurrencyEnum $currency = CurrencyEnum::CZK;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    public function __toString(): string
    {
        return (string) ($this->name ?? 'Customer #'.$this->id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = trim($name);
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description?->trim();
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email ? trim(mb_strtolower($email)) : null;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone ? trim($phone) : null;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }
    public function setWebsite(?string $website): self
    {
        $this->website = $website ? trim($website) : null;
        return $this;
    }

    public function getVatId(): ?string
    {
        return $this->vatId;
    }
    public function setVatId(?string $vatId): self
    {
        $this->vatId = $vatId ? trim($vatId) : null;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function isBillable(): bool
    {
        return $this->isBillable;
    }
    public function setIsBillable(bool $billable): self
    {
        $this->isBillable = $billable;
        return $this;
    }

    public function getDefaultHourlyRate(): ?int
    {
        return $this->defaultHourlyRate;
    }
    public function setDefaultHourlyRate(?int $rate): self
    {
        $this->defaultHourlyRate = $rate;
        return $this;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }
    public function setCurrency(CurrencyEnum $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $now = new \DateTimeImmutable();
        $this->createdAt ??= $now;
        $this->updatedAt ??= $now;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
