<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\CafeteriaUnsoldFoodService;

use function PHPSTORM_META\type;

class CafeteriaUnsoldFoodController extends Controller
{
    /**
     * @var CafeteriaUnsoldFoodService
     */

    private $cafeteriaUnsoldFoodService;

    /**
     * CafeteriaUnsoldFoodController constructor.
     * @param CafeteriaUnsoldFoodService $cafeteriaUnsoldFoodService
     */

    public function __construct(CafeteriaUnsoldFoodService $cafeteriaUnsoldFoodService)
    {
        $this->cafeteriaUnsoldFoodService = $cafeteriaUnsoldFoodService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $unsoldFoods = $this->cafeteriaUnsoldFoodService->findAll();
        // dd($unsoldFoods);
        // foreach ($unsoldFoods as $item) {

        //     echo " - ---------------------------------------------------------- - - - ";
        //     dd(($item->rawMaterial->unitPrices['0']->price));
        //     echo '<br>';
        // }

        return view('cafeteria::unsold-food.index', compact('unsoldFoods'));
    }

    public function moveUnsoldFoods()
    {
        $this->cafeteriaUnsoldFoodService->moveUnsoldFoods();

        return redirect()->route('finish-foods.index')->with('success', __('labels.save_success'));
    }
}
