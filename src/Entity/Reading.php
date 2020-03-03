<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReadingRepository")
 */
class Reading
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $temp;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $humidity;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $pressure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemp(): ?string
    {
        return $this->temp;
    }

    public function setTemp(?string $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getHumidity(): ?string
    {
        return $this->humidity;
    }

    public function setHumidity(?string $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getPressure(): ?string
    {
        return $this->pressure;
    }

    public function setPressure(?string $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }
}
