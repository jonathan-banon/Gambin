<?php

namespace App\Service;

use App\Entity\Rent;
use Doctrine\Common\Collections\Collection;

class Price
{
    public function calculation(Rent $rent)
    {
        $days = $rent->countDays();
        $price = 0;

        foreach ($rent->getItemProducts() as $itemProduct) {
            $price += $itemProduct->getQuantity() * ($itemProduct->getProduct()->getPriceService()
                      + $itemProduct->getProduct()->getPriceClean()
                      + $days * $itemProduct->getProduct()->getPricePerDay());
        }

        foreach ($rent->getItemAccessories() as $itemAccessory) {
            $price += $itemAccessory->getQuantity() * ($itemAccessory->getAccessory()->getPriceService()
                + $itemAccessory->getAccessory()->getPriceClean()
                + $days * $itemAccessory->getAccessory()->getPricePerDay());
        }

        return $price;
    }
}
