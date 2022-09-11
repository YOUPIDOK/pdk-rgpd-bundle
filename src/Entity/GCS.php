<?php

namespace Pdk\RgpdBundle\Entity;

use Pdk\RgpdBundle\Repository\GCSRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: GCSRepository::class)]
#[ORM\Table('rgpd__gcs')]
class GCS
{
    use RgpdTrait;
    use TimestampableEntity;

    public function __toString(): string
    {
        return "Conditions générales de vente" . ($this->implementationDate !== null ? (' du ' . $this->implementationDate->format('d/m/Y h:i:s')   ) : '') ;
    }
}
