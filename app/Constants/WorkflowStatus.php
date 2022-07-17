<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/29/19
 * Time: 12:18 PM
 */

namespace App\Constants;


abstract class WorkflowStatus
{
    const INITIATED = 'INITIATED';
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    const REJECTED = 'REJECTED';
    const CLOSED = 'CLOSED';
    const REINITIATED = 'REINITIATED';
    const REVIEW = 'REVIEW';
}
