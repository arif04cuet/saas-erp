<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/29/19
 * Time: 12:15 PM
 */

namespace App\Constants;


abstract class NotificationType
{
    const RESEARCH_PROPOSAL_SUBMISSION = 'Research Proposal Notification';
    const PROJECT_PROPOSAL_SUBMISSION = 'Project Proposal Submission';
    const IMS_WORKFLOW = 'IMS WORKFLOW';
    const IMS_AUCTION_WORKFLOW = 'IMS AUCTION WORKFLOW';
    const HRM_LEAVE_REQUEST_WORKFLOW = 'HRM LEAVE REQUEST WORKFLOW';
    const HRM_CIRCULAR = 'HRM CIRCULAR';
    const HRM_COMPLAINT = 'HRM COMPLAINT';
    const HRM_COMPLAINT_INVITATION = 'HRM COMPLAINT INVITATION';
    const HRM_APPRAISAL_REQUEST = 'HRM APPRAISAL REQUEST';
    const EXCEL_EXPORT_FINISHED = 'EXCEL EXPORT FINISHED';
    const TMS_COURSE_ADMINISTRATION = 'TMS COURSE ADMINISTRATION';
    const VMS_TRIP_REQUEST = 'VMS TRIP REQUEST';
    const VMS_FUEL_BILL_REQUEST = 'VMS FUEL BILL SUBMIT REQUEST';
    const VMS_MAINTENANCE_REQUISITION_REQUEST = 'VMS MAINTENANCE REQUISITION REQUEST';
    const HM_BUDGET_SUBMISSION = 'HOSTEL BUDGET SUBMISSION';
    const INVENTORY_ITEM_REQUEST = 'INVENTORY ITEM REQUEST';
    const REST_RECREATIONAL_LEAVE = 'REST RECREATIONAL LEAVE';
    const CAFETERIA_FOOD_ORDER = 'CAFETERIA FOOD ORDER';
    const MMS_PATIENT_REGISTRATION = 'MMS PATIENT REGISTRATION';
    const MMS_PRESCRIPTION_REQUEST = 'MMS PRESCRIPTION REQUEST';
    const PUBLICATION_REQUEST = 'PUBLICATION REQUEST';
    const HOUSE_ALLOCATION = 'HOUSE ALLOCATION';
    const DELIVERY_MATERIAL_REQUEST = 'DELIVERY MATERIAL REQUEST';


    public static function getConstant($const)
    {
        switch ($const) {
            case ($const == "RESEARCH_PROPOSAL_SUBMISSION"):
                return self::RESEARCH_PROPOSAL_SUBMISSION;
                break;
            case ($const == "PROJECT_PROPOSAL_SUBMISSION"):
                return self::PROJECT_PROPOSAL_SUBMISSION;
                break;
            case ($const == "IMS_WORKFLOW"):
                return self::IMS_WORKFLOW;
                break;
            case ($const == "IMS_AUCTION_WORKFLOW"):
                return self::IMS_AUCTION_WORKFLOW;
                break;
            case ($const == "HRM_LEAVE_REQUEST_WORKFLOW"):
                return self::HRM_LEAVE_REQUEST_WORKFLOW;
                break;
            case ($const == "HRM_CIRCULAR"):
                return self::HRM_LEAVE_REQUEST_WORKFLOW;
                break;
            case ($const == "HRM_COMPLAINT"):
                return self::HRM_COMPLAINT;
                break;
            case ($const == "HRM_COMPLAINT_INVITATION"):
                return self::HRM_COMPLAINT_INVITATION;
                break;
            case ($const == "HRM_APPRAISAL_REQUEST"):
                return self::HRM_APPRAISAL_REQUEST;
                break;
            case ($const == "EXCEL_EXPORT_FINISHED"):
                return self::EXCEL_EXPORT_FINISHED;
                break;
            case ($const == "TMS_COURSE_ADMINISTRATION");
                return self::TMS_COURSE_ADMINISTRATION;
                break;
            case ($const == "VMS_TRIP_REQUEST");
                return self::VMS_TRIP_REQUEST;
                break;
            case ($const == "VMS_FUEL_BILL_REQUEST");
                return self::VMS_FUEL_BILL_REQUEST;
                break;
            case ($const == "VMS_MAINTENANCE_REQUISITION_REQUEST");
                return self::VMS_MAINTENANCE_REQUISITION_REQUEST;
                break;
            case ($const == "HOSTEL BUDGET SUBMISSION");
                return self::HM_BUDGET_SUBMISSION;
                break;
            case ($const == "INVENTORY_ITEM_REQUEST");
                return self::INVENTORY_ITEM_REQUEST;
                break;
            case ($const == "REST_RECREATIONAL_LEAVE");
                return self::REST_RECREATIONAL_LEAVE;
            case ($const == "CAFETERIA_FOOD_ORDER");
                return self::CAFETERIA_FOOD_ORDER;
                break;
            case ($const == "MMS_PATIENT_REGISTRATION");
                return self::MMS_PATIENT_REGISTRATION;
                break;
            case ($const == "MMS_PRESCRIPTION_REQUEST");
                return self::MMS_PRESCRIPTION_REQUEST;
                break;
            case ($const == "PUBLICATION REQUEST");
                return self::PUBLICATION_REQUEST;
                break;
            case ($const == "HOUSE ALLOCATION");
                return self::HOUSE_ALLOCATION;
                break;
            case ($const == "DELIVERY MATERIAL REQUEST");
                return self::DELIVERY_MATERIAL_REQUEST;
                break;
            default:
                return self::RESEARCH_PROPOSAL_SUBMISSION;
                break;
        }
    }
}
