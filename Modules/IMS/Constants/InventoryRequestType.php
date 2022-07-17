<?php


namespace Modules\IMS\Constants;


abstract class InventoryRequestType
{
    const REQUISITION = 'requisition';
    const TRANSFER = 'transfer';
    const SCRAP = 'scrap';
    const ABANDON = 'abandon';
}