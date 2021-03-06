<?php

declare(strict_types=1);

namespace Setono\SyliusStockMovementPlugin\Model;

use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface StockMovementInterface extends ResourceInterface, TimestampableInterface
{
    /**
     * The number of items.
     *
     * If the quantity is negative it means an outgoing stock movement, i.e. you've sold a product
     * Contrary a positive number means an ingoing stock movement, i.e. you had a return or a delivery
     *
     * @return int
     */
    public function getQuantity(): ?int;

    public function setQuantity(int $quantity): void;

    public function getVariant(): ?ProductVariantInterface;

    public function setVariant(?ProductVariantInterface $productVariant): void;

    public function getVariantCode(): ?string;

    public function setVariantCode(?string $variantCode): void;

    public function getReference(): ?string;

    public function setReference(?string $reference): void;
}
