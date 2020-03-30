<?php
namespace App\Traits;

use App;

trait AreaHelper
{

    public function AreaFinder($area_origin, $area_destination, $transportation_mode, $travel_model, $parking_guarantor)
    {

        if ($travel_model == 0) {

            if (collect($area_origin)->contains(3) || collect($area_destination)->contains(3)) {
                return array(1);
            }
            if (collect($area_origin)->contains(2) || collect($area_destination)->contains(2)) {
                return array(2);
            }
            if (collect($area_destination)->contains(1) && $parking_guarantor == 1) {

                if ((collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) && collect($area_origin)->contains(5)) {
                    return array(4, 5, 6, 7);
                }
                if ((collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) && collect($area_origin)->contains(5)) {
                    return array(3, 5, 6, 7);
                }
                if (collect($area_origin)->contains(4)) {
                    if (collect($transportation_mode)->contains(3) && collect($transportation_mode)->contains(4)) {
                        return array(8, 10);
                    }
                    if (collect($transportation_mode)->contains(5) && collect($transportation_mode)->contains(6)) {
                        return array(8, 9);
                    }
                }
                if (collect($transportation_mode)->contains(3) && collect($transportation_mode)->contains(4)) {
                    return array(8, 12);
                }
                if (collect($transportation_mode)->contains(5) && collect($transportation_mode)->contains(6)) {
                    return array(8, 11);
                }
            }
            if (collect($area_origin)->contains(5)) {
                return array(5, 6);
            }

            if (collect($area_origin)->contains(4)) {
                if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
                    return array(8, 10);
                }
                if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                    return array(8, 9);
                }
            }
            if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
                return array(8, 12);
            }
            if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                return array(8, 11);
            }

        } else {
            if (collect($area_origin)->contains(3) || collect($area_destination)->contains(3)) {
                return array(1);
            }
            if (collect($area_origin)->contains(2) || collect($area_destination)->contains(2)) {
                return array(2);
            }
            if (collect($area_origin)->contains(5)) {
                return array(5, 6);
            }
            if ($travel_model == 2) {
                if (collect($area_origin)->contains(4)) {
                    if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
                        return array(8, 10);
                    }
                    if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                        return array(8, 9);
                    }
                }
                if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
                    return array(8, 12);
                }
                if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                    return array(8, 11);
                }
            }
        }

        /*
    Area :
    1. Parkir
    2. Cycle
    3. Pedestrian
    4. Park and Ride
    5. Feeder

    Survey Preference :
    1. Pedestrian
    2. Cycle
    3. Park Car
    4. Park Motor
    5. Feeder Reguler
    6. Feeder Premium
    7. Feeder Park
    8. Park Ride Common
    9. Park Ride Car
    10. Park Ride Motor
    11. Park Ride Car (Hypo)
    12. Park Ride Motor (Hypo)
     */
    }

}
