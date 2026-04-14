<?php

use App\Models\Entities;
use App\Models\Approver;

if (!function_exists('getStampPosition')) {
    function getStampPosition($entityId) {
        $positions = [
            1 => ['bottom' => '65mm', 'left' => '20mm', 'rotate' => '-5deg'],
            2 => ['bottom' => '65mm', 'left' => '20mm', 'rotate' => '-5deg'],
            3 => ['bottom' => '65mm', 'left' => '20mm', 'rotate' => '-5deg'],
        ];
        
        return $positions[$entityId] ?? ['bottom' => '65mm', 'left' => '20mm', 'rotate' => '-5deg'];
    }
}

if (!function_exists('generateDocumentNo')) {
    function generateDocumentNo($employeeNo,$entityId,$approvalDate) {

        #Combination NO.SKET/employee No/Bulan dalam romawi/Tahun
        $month = date('n', strtotime($approvalDate));
        $year = date('Y', strtotime($approvalDate));
        $monthRomawi = array(
            1 => 'I', 
            2 => 'II', 
            3 => 'III',
            4 => 'IV', 
            5 => 'V', 
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );

        $bulanRomawi = $monthRomawi[$month];

        return 'SKET/'.$employeeNo.'/'.getEntityCode($entityId).'/'.$bulanRomawi.'/'.$year;
    }
}

if (!function_exists('getEntityCode')) {
    function getEntityCode($entityId) {
        $entities = Entities::where('id', $entityId)->first();
        return $entities->entity_code;
    }
}


if (!function_exists('getSignPosition')) {
    function getSignPosition($signPosition) {

        $string = $signPosition;
        $array = explode(",", $string);
        
        return $array;
    }
}

if (!function_exists('getRandDegree')) {
    function getRandDegree() {
        $degrees = array(
            -5,
            -4,
            -3,
            -2,
            -1,
            0,
            1,
            2,
            3,
            4,
            5
        );
        return $degrees[array_rand($degrees)];
    }
}

if (!function_exists('getRandomLeft')) {
    function getRandomLeft() {
        $lefts = array(
            15,
            16,
            17,
            18,
            19,
            20,
            // 21,
            // 22,
            // 23,
            // 24,
            // 25
        );
        return $lefts[array_rand($lefts)];
    }
}

if (!function_exists('getRandomBottom')) {
    function getRandomBottom() {
        $bottoms = array(
            68,
            69,
            70,
            71,
            72,
        );
        return $bottoms[array_rand($bottoms)];
    }
}

if (!function_exists('getApproverId')) {
    function getApproverId($entityId) {
        $approver = Approver::where('entity_id', $entityId)->first();
        return $approver->id;
    }
}