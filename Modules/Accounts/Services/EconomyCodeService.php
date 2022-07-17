<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/24/18
 * Time: 7:31 PM
 */

namespace Modules\Accounts\Services;


use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Modules\Accounts\Repositories\EconomyCodeRepository;

class EconomyCodeService
{
    use CrudTrait;

    protected $economyCodeRepository;

    /**
     * AccountHeadServices constructor.
     * @param EconomyCodeRepository $economyCodeRepository
     */
    public function __construct(EconomyCodeRepository $economyCodeRepository)
    {
        $this->economyCodeRepository = $economyCodeRepository;
        $this->setActionRepository($this->economyCodeRepository);
    }

    /**
     * <h3>Economy Codes</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getEconomyCodesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $economyCodes = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $economyCodes,
            $implementedKey,
            $implementedValue ? : function($economyCode) use ($lang) {
                $name = $lang == 'bn' ? $economyCode->bangla_name : $economyCode->english_name;
                return $economyCode->code . ' - ' . $name;
            },
            $isEmptyOption
        );
    }


}
