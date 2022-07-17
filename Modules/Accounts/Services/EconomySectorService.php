<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Repositories\EconomySectorRepository;

class EconomySectorService
{
    use CrudTrait;
    /**
     * @var EconomySectorRepository
     */
    private $economySectorRepository;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;

    /**
     * EconomySectorService constructor.
     *
     * @param EconomySectorRepository $economySectorRepository
     * @param EconomyCodeService $economyCodeService
     */
    public function __construct(
        EconomySectorRepository $economySectorRepository,
        EconomyCodeService $economyCodeService
    ) {
        $this->economySectorRepository = $economySectorRepository;
        $this->setActionRepository($economySectorRepository);
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Saves a sector to the database
     *
     * @param array $data
     *
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function saveSector(array $data)
    {
        $data['code'] = $data['parent_economy_code'] . $data['code'];
        try {
            $save = $this->save($data);
            Session::flash('success', __('labels.save_success'));
            return $save;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 23000) {
                Session::flash('error', __('validation.unique', ['attribute' => __('labels.code')]));
            } else {
                Session::flash('error', __('labels.save_fail') . ' ' .
                    __('labels.error_code', ['code' => $exception->getCode()]));
            }
            return false;
        }
    }

    /**
     * Updates a sector
     *
     * @param array $data
     * @param         $id
     *
     * @return bool|\Illuminate\Http\RedirectResponse|int
     */
    public function updateSector(array $data, $id)
    {
        $data['code'] = $data['parent_economy_code'] . $data['code'];
        try {
            $update = $this->findOrFail($id)->update($data);
            Session::flash('success', __('labels.update_success'));
            return $update;
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', __('labels.update_fail') . ' ' .
                __('labels.error_code', ['code' => $exception->getCode()]));
        }
    }

    /**
     * @return array
     */
    public function getEconomyCodeForDropdown()
    {
        $implementedKey = function ($item) {
            return $item->code;
        };
        return $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            $implementedKey,
            null,
            true
        );
    }

    /**
     * @param $code
     *
     * @return |null
     */
    public function getSectors($code)
    {
        $economyCode = $this->economyCodeService->findBy(['code' => $code])->first();
        return $economyCode ? $economyCode->economySectors : null;
    }

    /**
     * @param bool $localize
     * @return array
     */
    public function getEconomyCodeWithSectorsForDropdown($localize = false): array
    {
        $economyCodes = EconomyCode::with('economySectors')->get();
        $formattedData = [];
        foreach ($economyCodes as $economyCode) {
            $code = $economyCode->code;
            if ($localize && (app()->isLocale('en'))) {
                $implementedValue = $economyCode->code . ' - ' . $economyCode->english_name;
            } else {
                $implementedValue = $economyCode->code . ' - ' . $economyCode->bangla_name;
            }
            $formattedData[$code] = $implementedValue;
            // find economy sectors
            $economySectors = $economyCode->economySectors;
            if ($economySectors->count()) {
                $childCodes = $this->getChildCodesFormatted($localize, $economySectors);
                unset($formattedData[$code]);
                if ($localize && (app()->isLocale('en'))) {
                    $formattedData[$economyCode->code . ' - ' . $economyCode->english_name] = $childCodes;;
                } else {
                    $formattedData[$economyCode->code . ' - ' . $economyCode->bangla_name] = $childCodes;;
                }
            }
        }
        return $formattedData;
    }

    private function getChildCodesFormatted($localize, $economySectors)
    {
        $childCodes = [];
        foreach ($economySectors as $sector) {
            if ($localize && (app()->isLocal('en'))) {
                $name = $sector->title;
            } else {
                $name = $sector->title_bangla;
            }
            $childCodes[$sector->code] = $sector->code . ' - ' . $name;
        }
        return $childCodes;
    }
}

