<?php

namespace App\Application;

final class CreateRegistryResponseDto
{

    private $id;
    private $name;
    private $startTime = null;
    private $endTime = null;
    private $totalTime;

    public function __construct($id, $name, $startTime, $endTime, $totalTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->totalTime = $totalTime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getTotalTime()
    {
        return $this->totalTime;
    }
}