<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/24/18
 * Time: 7:31 PM
 */

namespace Modules\Accounts\Services;


use App\Traits\CrudTrait;
use Closure;
use Illuminate\Support\Facades\Lang;
use Modules\Accounts\Repositories\EconomyHeadRepository;

class EconomyHeadService
{
    use CrudTrait;

    protected $economyHeadRepository;

    /**
     * AccountHeadServices constructor.
     * @param EconomyHeadRepository $economyHeadRepository
     */
    public function __construct(EconomyHeadRepository $economyHeadRepository)
    {
        $this->economyHeadRepository = $economyHeadRepository;
        $this->setActionRepository($economyHeadRepository);
    }

    /**
     * <h3>Economy Heads</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param bool $emptyOption
     * @return array
     */
    public function getEconomyHeadsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        $emptyOption = false
    ) {
        $economyHeads = $this->actionRepository->findAll();

        $economyHeadOptions = [];

        if ($emptyOption) $economyHeadOptions[0] = Lang::trans('labels.select');

        foreach ($economyHeads as $economyHead) {
            $economyHeadKey = $implementedKey ? $implementedKey($economyHead) : $economyHead->id;

            $implementedValue = $implementedValue ?: function ($economyHead) {
                return $economyHead->code . ' - ' . $economyHead->bangla_name;
            };

            $economyHeadOptions[$economyHeadKey] = $implementedValue($economyHead);
        }

        return $economyHeadOptions;
    }

    public function getTypeHeads()
    {
        return $this->actionRepository->getModel()->typeHeads();
    }
}
