<?php


namespace Modules\Accounts\Exports\Payroll;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;

class PayslipCoverExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{

    /**
     * @return View
     */
    public function view(): View
    {
        // TODO: Implement view() method.
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
    }

    /**
     * @return string
     */
    public function title(): string
    {
        // TODO: Implement title() method.
    }
}
