<?php

namespace App\Entity;

use App\Repository\DeliveryInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryInfoRepository::class)]
class DeliveryInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryName = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryMethod = null;

    #[ORM\OneToOne(mappedBy: 'deliveryInfo', cascade: ['persist', 'remove'])]
    private ?Order $orderInfo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getDeliveryName(): ?string
    {
        return $this->deliveryName;
    }

    public function setDeliveryName(string $deliveryName): static
    {
        $this->deliveryName = $deliveryName;

        return $this;
    }

    public function getDeliveryMethod(): ?string
    {
        return $this->deliveryMethod;
    }

    public function setDeliveryMethod(string $deliveryMethod): static
    {
        $this->deliveryMethod = $deliveryMethod;

        return $this;
    }

    public function getOrderInfo(): ?Order
    {
        return $this->orderInfo;
    }

    public function setOrderInfo(?Order $orderInfo): static
    {
        // unset the owning side of the relation if necessary
        if ($orderInfo === null && $this->orderInfo !== null) {
            $this->orderInfo->setDeliveryInfo(null);
        }

        // set the owning side of the relation if necessary
        if ($orderInfo !== null && $orderInfo->getDeliveryInfo() !== $this) {
            $orderInfo->setDeliveryInfo($this);
        }

        $this->orderInfo = $orderInfo;

        return $this;
    }
}
