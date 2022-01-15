<?php
class Pickup
{
  public $id, $type, $startTime, $endTime, $weekday;
  public function __construct()
  {
    $this->startTime = substr($this->startTime, 0, 5);
    $this->endTime = substr($this->endTime, 0, 5);
  }
}
