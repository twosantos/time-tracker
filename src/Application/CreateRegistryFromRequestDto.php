<?php

namespace App\Application;
use \DateTime;

final class CreateRegistryFromRequestDto
{

    private $name;
    private $startTime = null;
    private $endTime = null;
    private $totalTime;

    public function __construct($data)
    {
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        $this->name = $data['name'];
        if (!empty($data['startTime'])){ 
            $this->startTime = (new DateTime())->setTimestamp($data['startTime']);
        }
        if (!empty($data['endTime'])) {
            $this->endTime = (new DateTime())->setTimestamp($data['endTime']);
        }
        if (!empty($this->startTime) && !empty($this->endTime)) {
            $this->totalTime = $this->endTime->getTimestamp() - $this->startTime->getTimestamp();
        }
  }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    public function getStartTime(): ?DateTime
    {
        return $this->startTime;
    }

    public function getTotalTime()
    {
        return $this->totalTime;
    }
}