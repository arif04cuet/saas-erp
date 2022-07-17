<?php

use Illuminate\Database\Seeder;

class WorkflowRuleDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('workflow_rule_details')->delete();

        \DB::table('workflow_rule_details')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'rule_master_id' => 1,
                    'designation_id' => NULL,
                    'notification_order' => 1,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'INITIAL',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'approval',
                    'is_optional' => 0,
                    'is_shareable' => 0,
                    'share_rule_id' => NULL,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Approve',
                    'reject_btn_label' => 'Reject',
                ),
            1 =>
                array(
                    'id' => 2,
                    'rule_master_id' => 1,
                    'designation_id' => 160, // previous id was 22 - research director
                    'notification_order' => 2,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'PREVIOUS',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'review',
                    'is_optional' => 0,
                    'is_shareable' => 1,
                    'share_rule_id' => 1,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Share',
                    'reject_btn_label' => 'Reject',
                ),
            2 =>
                array(
                    'id' => 3,
                    'rule_master_id' => 2,
                    'designation_id' => NULL,
                    'notification_order' => 1,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'INITIAL',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'approval',
                    'is_optional' => 0,
                    'is_shareable' => 0,
                    'share_rule_id' => NULL,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Approve',
                    'reject_btn_label' => 'Reject',
                ),
            3 =>
                array(
                    'id' => 4,
                    'rule_master_id' => 2,
                    'designation_id' => 160, // previous id was 23 - project director
                    'notification_order' => 2,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'PREVIOUS',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'review',
                    'is_optional' => 0,
                    'is_shareable' => 1,
                    'share_rule_id' => 2,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Review complete',
                    'reject_btn_label' => 'Reject',
                ),
            4 =>
                array(
                    'id' => 5,
                    'rule_master_id' => 3,
                    'designation_id' => 160, // previous id was 22 - research director
                    'notification_order' => 1,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'INITIAL',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'approval',
                    'is_optional' => 0,
                    'is_shareable' => 1,
                    'share_rule_id' => 25,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Approve',
                    'reject_btn_label' => 'Reject',
                ),
            5 =>
                array(
                    'id' => 6,
                    'rule_master_id' => 4,
                    'designation_id' => NULL,
                    'notification_order' => 1,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'INITIAL',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'approval',
                    'is_optional' => 0,
                    'is_shareable' => 0,
                    'share_rule_id' => NULL,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Approve',
                    'reject_btn_label' => 'Reject',
                ),
            6 =>
                array(
                    'id' => 7,
                    'rule_master_id' => 4,
                    'designation_id' => 160, // previous id was 22 - research director
                    'notification_order' => 2,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'PREVIOUS',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'review',
                    'is_optional' => 0,
                    'is_shareable' => 1,
                    'share_rule_id' => 13,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Share',
                    'reject_btn_label' => 'Reject',
                ),
            7 =>
                array(
                    'id' => 8,
                    'rule_master_id' => 5,
                    'designation_id' => NULL,
                    'notification_order' => 1,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'INITIAL',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'approval',
                    'is_optional' => 0,
                    'is_shareable' => 0,
                    'share_rule_id' => NULL,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Approve',
                    'reject_btn_label' => 'Reject',
                ),
            8 =>
                array(
                    'id' => 9,
                    'rule_master_id' => 5,
                    'designation_id' => 160, // previous id was 23 - project director
                    'notification_order' => 2,
                    'number_of_responder' => 1,
                    'is_group_notification' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'get_back_status' => 'PREVIOUS',
                    'back_to_rule' => NULL,
                    'proceed_to_status' => 'NEXT',
                    'proceed_to_rule' => NULL,
                    'flow_type' => 'review',
                    'is_optional' => 0,
                    'is_shareable' => 1,
                    'share_rule_id' => 14,
                    'can_approve' => 0,
                    'back_btn_label' => 'Send Back',
                    'proceed_btn_label' => 'Review complete',
                    'reject_btn_label' => 'Reject',
                ),
        ));


    }
}