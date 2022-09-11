<?php

namespace Pdk\RgpdBundle\Entity;

use Pdk\RgpdBundle\Repository\PrivacyPolicyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: PrivacyPolicyRepository::class)]
#[ORM\Table('rgpd__privacy_policy')]
class PrivacyPolicy
{
    use RgpdTrait;
    use TimestampableEntity;

    public function __toString(): string
    {
        return 'Politique de confidentialité' . ($this->implementationDate !== null ? (' du ' . $this->implementationDate->format('d/m/Y h:i:s')   ) : '') ;
    }
}
