<?php

namespace App\Entity;

use App\Repository\RegistryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Application\CreateRegistryFromRequestDto;
use App\Application\CreateRegistryResponseDto;

#[ORM\Entity(repositoryClass: RegistryRepository::class)]
class Registry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalTime = null;

    private function __construct(
        $id,
        $name,
        $startTime,
        $endTime,
        $totalTime
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->totalTime = $totalTime;
    }

    public static function fromDto(CreateRegistryFromRequestDto $createRegistryFromRequestDto)
    {
        return new Registry(
            null,
            $createRegistryFromRequestDto->getName(),
            $createRegistryFromRequestDto->getStartTime(),
            $createRegistryFromRequestDto->getEndTime(),
            $createRegistryFromRequestDto->getTotalTime(),
        );
    }

    public function toDto()
    {
        return new CreateRegistryResponseDto(
            $this->id,
            $this->name,
            $this->startTime,
            $this->endTime,
            $this->totalTime
        );   
    }
}
