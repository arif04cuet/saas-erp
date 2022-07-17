<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 7/16/19
 * Time: 12:06 PM
 */

namespace App\Services;

use App\Entities\District;
use App\Entities\Thana;
use App\Repositories\DivisionRepository;

class AddressService
{
    private $divisionRepository;

    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function getDivisions()
    {
        return $this->divisionRepository->findAll();
    }

    public function getDistricts()
    {
        return District::all();
    }

    public function getThanas()
    {
        return Thana::all();
    }

    public function getThanasByDistrictName($districtName)
    {
        $district = District::where('name', $districtName)->first();
        return (empty($district))? [] : $district->thanas;
    }

}