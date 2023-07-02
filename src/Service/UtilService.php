<?php

namespace src\Service;

class UtilService {

    public static function purifyOneFetchAll(array $tab): array 
    {
        foreach ($tab as $key => $value) {
            if (is_numeric($key)) {
                unset($tab[$key]);
            }
        }
        
        return $tab;
    }

    public static function purifyFetchAll(array $tab): array 
    {
        foreach($tab as $key => $item){
            $tab[$key] = self::purifyOneFetchAll($item);
        }

        return $tab;
    }

    
}