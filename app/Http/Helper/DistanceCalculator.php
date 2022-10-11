<?php
namespace App\Http\Helper;

use App\Models\User;

class DistanceCalculator
{
    public function calculateDistance($orderedBy, $perparedBy)
    {

        $user1 = User::find((int) $orderedBy);
        $user2 = User::find((int) $perparedBy);

        $earthRad = 6371000;

        $long1 = deg2rad($user1->longitude);
        $long2 = deg2rad($user2->longitude);
        $lat1 = deg2rad($user1->latitude);
        $lat2 = deg2rad($user2->latitude);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $angle = 2 * asin(sqrt(pow(sin($dlati / 2), 2) +
        cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2)));
        return round(($angle * $earthRad)/1000, 2);
    }
}
