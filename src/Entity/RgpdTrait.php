<?php

namespace Pdk\RgpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;
use Doctrine\DBAL\Types\Types;

Trait RgpdTrait {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING)]
    #[NotNull]
    private ?string $versionNumber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $implementationDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotNull]
    private ?string $body = null;

    #[ORM\Column]
    private ?bool $isDraft = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getVersionNumber(): ?string
    {
        return $this->versionNumber;
    }

    public function setVersionNumber(?string $versionNumber): self
    {
        $this->versionNumber = $versionNumber;

        return $this;
    }

    public function getImplementationDate(): ?\DateTime
    {
        return $this->implementationDate;
    }

    public function setImplementationDate(\DateTime $implementationDate): self
    {
        $this->implementationDate = $implementationDate;

        return $this;
    }

    public function isDraft(): ?bool
    {
        return $this->isDraft;
    }

    public function setIsDraft(bool $isDraft): self
    {
        $this->isDraft = $isDraft;

        return $this;
    }
}