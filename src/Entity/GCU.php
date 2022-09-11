<?php

namespace Pdk\RgpdBundle\Entity;

use Pdk\RgpdBundle\Repository\GCURepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: GCURepository::class)]
#[ORM\Table('rgpd__gcu')]
class GCU
{
    use TimestampableEntity;
    use RgpdTrait;

    public function __toString(): string
    {
        return "Conditions générales d'utilisation" . ($this->implementationDate !== null ? (' du ' . $this->implementationDate->format('d/m/Y h:i:s')   ) : '') ;
    }
}
