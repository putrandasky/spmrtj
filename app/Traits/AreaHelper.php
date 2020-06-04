<?php
namespace App\Traits;

use App;

trait AreaHelper
{

    public function AreaFinder($area_origin, $area_destination, $transportation_mode, $travel_model, $parking_guarantor, $vehicle_availability)
    {
        $data = array();
        // dd(collect($area_destination)->contains(1));

        // instruksi untuk semua pengguna mobil pribadi akan dapat sp mobil, begitu juga dengan sepeda motor
        if ($travel_model == 0 || $travel_model == 2) {
            if ((collect($transportation_mode)->contains(3))) {
                //Jika moda transportasi yang dipilih motor pribadi
                array_push($data, 4);
            }
            if (collect($transportation_mode)->contains(5)) {
                //Jika moda transportasi yang dipilih mobil pribadi
                array_push($data, 3);
            }
        }

        if ($travel_model == 0) {
            //JIka origin dan destination terlayani jalur pedestrian

            if (collect($area_origin)->contains(3) && collect($area_destination)->contains(3)) {
                array_push($data, 1);
            } else {
                //JIka origin dan destination terlayani jalur sepeda
                if (collect($area_origin)->contains(2) && collect($area_destination)->contains(2)) {
                    array_push($data, 2);
                }
            }
            if (collect($area_destination)->contains(1) && $parking_guarantor == 1) {
                //jika destinasi masuk area parkir dan penganggung jawab parkir pribadi
                if ((collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4))) {
                    //Jika moda transportasi yang dipilih motor pribadi
                    // array_push($data, 4);
                    if (collect($area_origin)->contains(5)) {
                        //jika origin masuk feeder
                        array_push($data, 5, 6, 7);
                        return $data;
                    } else {
                        //jika origin tidak masuk feeder
                        array_push($data, 8);
                        if (collect($area_origin)->contains(4)) {
                            //jika origin masuk Park Ride
                            array_push($data, 10);
                            return $data;
                        } else {
                            //jika origin tidak masuk Park Ride
                            array_push($data, 12);
                            return $data;
                        }

                    }
                }
                if ((collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6))) {
                    //Jika moda transportasi yang dipilih mobil pribadi
                    // array_push($data, 3);
                    if (collect($area_origin)->contains(5)) {
                        //jika origin masuk feeder
                        array_push($data, 5, 6, 7);
                        //diganti menjadi SP park ride mobil untuk menaikan survei kategori tsb
                        // array_push($data, 8, 9);
                        return $data;
                    } else {
                        //jika origin tidak masuk feeder
                        array_push($data, 8);
                        if (collect($area_origin)->contains(4)) {
                            //jika origin masuk Park Ride
                            array_push($data, 9);
                            return $data;
                        } else {
                            //jika origin tidak masuk Park Ride
                            array_push($data, 11);
                            return $data;
                        }

                    }
                }
            } else {
                //jika destinasi tidak masuk area parkir dan penganggung jawab parkir pribadi
                if (collect($area_origin)->contains(5)) {
                    // Jika origin masuk area feeder
                    array_push($data, 5, 6);
                    return $data;
                } else {
                    // Jika origin tidak masuk area feeder
                    array_push($data, 8);
                    if (collect($area_origin)->contains(4)) {
                        //Jika origin masuk area park ride
                        if ((collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4))) {
                            //jika motor pribadi
                            array_push($data, 10);
                            return $data;
                        }
                        if ((collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6))) {
                            //jika mobil pribadi
                            array_push($data, 9);
                            return $data;
                        }

                    } else {
                        //Jika origin tidak masuk area park ride
                        if ((collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4))) {
                            //jika motor pribadi
                            array_push($data, 12);
                            return $data;
                        }
                        if ((collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6))) {
                            //jika mobil pribadi
                            array_push($data, 11);
                            return $data;
                        }
                    }
                }
            }
        } else {
            if (collect($area_origin)->contains(3) || collect($area_destination)->contains(3)) {
                array_push($data, 1);
            }
            if (collect($area_origin)->contains(2) || collect($area_destination)->contains(2)) {
                array_push($data, 2);
            }
            if (collect($area_origin)->contains(5)) {
                array_push($data, 5, 6);
                return $data;
            } else {
                if (collect($area_origin)->contains(4)) {
                    if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                        array_push($data, 8, 9);
                        return $data;
                    } else {
                        array_push($data, 8, 10);
                        return $data;
                    }
                } else {
                    if ($vehicle_availability == 2) {
                        array_push($data, 8, 11);
                        return $data;
                    }
                    if ($vehicle_availability == 1 || $vehicle_availability == 3) {
                        array_push($data, 8, 12);
                        return $data;
                    }
                    return $data;
                }
                // if ($travel_model == 1) {
                //     //jika pengguna MRT
                //     if (collect($transportation_mode)->contains(17)) {
                //         array_push($data, 8, 12);
                //         return $data;
                //     } else {

                //         return $data;
                //     }
                // }
                // if ($travel_model == 2) {
                //     if (collect($area_origin)->contains(4)) {
                //         if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                //             array_push($data, 8, 9);
                //             return $data;
                //         } else {
                //             array_push($data, 8, 10);
                //             return $data;
                //         }
                //     } else {
                //         if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
                //             array_push($data, 8, 11);
                //             return $data;
                //         } else {
                //             array_push($data, 8, 12);
                //             return $data;
                //         }
                //     }
                // }
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

//     // dd(collect($area_destination)->contains(1));
    //     if ($travel_model == 0) {
    //         //JIka origin atau destination terlayani jalur pedestrian

//         if (collect($area_origin)->contains(3) || collect($area_destination)->contains(3)) {
    //             return array(1);
    //         }
    //         //JIka origin atau destination terlayani jalur sepeda
    //         if (collect($area_origin)->contains(2) || collect($area_destination)->contains(2)) {
    //             return array(2);
    //         }
    //         //JIka destination masuk jalur parkir dan penanggung parkir adalah pribadi
    //         if (collect($area_destination)->contains(1) && $parking_guarantor == 1) {
    //             //Jika Origin Terlayani Feeder
    //             if ((collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) && collect($area_origin)->contains(5)) {
    //                 return array(4, 5, 6, 7);
    //             }
    //             if ((collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) && collect($area_origin)->contains(5)) {
    //                 return array(3, 5, 6, 7);
    //             }
    //             //Jika Origin tidak Terlayani Feeder tapi Park Ride terlayani
    //             if (collect($area_origin)->contains(4)) {
    //                 if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //                     return array(4, 8, 10);
    //                 }
    //                 if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //                     return array(3, 8, 9);
    //                 }
    //             }
    //              //Jika Origin tidak Terlayani Feeder dan Park Ride tidak terlayani
    //             if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //                 return array(4, 8, 12);
    //             }
    //             if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //                 return array(3, 8, 11);
    //             }
    //         }
    //         //JIka destination tidak  masuk jalur parkir penanggung parkir bukan pribadi serta origin masuk feeder
    //         if (collect($area_origin)->contains(5)) {
    //             return array(5, 6);
    //         }
    //         //JIka destination tidak  masuk jalur parkir penanggung parkir bukan pribadi serta origin tidak masuk feeder tetapi tercakur park
    //         if (collect($area_origin)->contains(4)) {
    //             if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //                 return array(8, 10);
    //             }
    //             if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //                 return array(8, 9);
    //             }
    //         }
    //         //Jika tidak tercakup park ride
    //         if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //             return array(8, 12);
    //         }
    //         if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //             return array(8, 11);
    //         }
    //         return array();

//     } else {
    //         if (collect($area_origin)->contains(3) || collect($area_destination)->contains(3)) {
    //             return array(1);
    //         }
    //         if (collect($area_origin)->contains(2) || collect($area_destination)->contains(2)) {
    //             return array(2);
    //         }
    //         if (collect($area_origin)->contains(5)) {
    //             return array(5, 6);
    //         }
    //         if ($travel_model == 1) {
    //             //jika pengguna MRT
    //             if (collect($transportation_mode)->contains(17)) {
    //                 return array(8, 12);
    //             }
    //             return array();
    //         }
    //         if ($travel_model == 2) {
    //             if (collect($area_origin)->contains(4)) {
    //                 if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //                     return array(8, 10);
    //                 }
    //                 if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //                     return array(8, 9);
    //                 }
    //             }
    //             if (collect($transportation_mode)->contains(3) || collect($transportation_mode)->contains(4)) {
    //                 return array(8, 12);
    //             }
    //             if (collect($transportation_mode)->contains(5) || collect($transportation_mode)->contains(6)) {
    //                 return array(8, 11);
    //             }
    //         }
    //         return array();
    //     }

//     /*
    // Area :
    // 1. Parkir
    // 2. Cycle
    // 3. Pedestrian
    // 4. Park and Ride
    // 5. Feeder

// Survey Preference :
    // 1. Pedestrian
    // 2. Cycle
    // 3. Park Car
    // 4. Park Motor
    // 5. Feeder Reguler
    // 6. Feeder Premium
    // 7. Feeder Park
    // 8. Park Ride Common
    // 9. Park Ride Car
    // 10. Park Ride Motor
    // 11. Park Ride Car (Hypo)
    // 12. Park Ride Motor (Hypo)
    //  */
    // }

}
