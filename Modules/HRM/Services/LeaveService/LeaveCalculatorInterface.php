<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 7/4/19
 * Time: 4:20 PM
 */

namespace Modules\HRM\Services\LeaveService;


interface LeaveCalculatorInterface
{
    public function getAvailableLeaveDays(): int;

    public function getLeaveConfig(): object;

    public function isValidRequest(): bool;
}