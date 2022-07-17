<?php
    /**
     * Created by PhpStorm.
     * User: shomrat
     * Date: 10/24/18
     * Time: 7:31 PM
     */

    namespace Modules\Accounts\Services;


    use Maatwebsite\Excel\Facades\Excel;
    use Modules\Accounts\Imports\ImportEconomicCode;
    use Modules\Accounts\Repositories\AccountHeadRepository;
    use Modules\Accounts\Repositories\AccountLedgerRepository;

    class AccountService
    {
        protected $accountHeadRepository;
        protected $accountLedgerRepository;

        /**
         * AccountHeadServices constructor.
         * @param AccountHeadRepository $accountHeadRepository
         * @param AccountLedgerRepository $accountLedgerRepository
         */
        public function __construct(AccountHeadRepository $accountHeadRepository, AccountLedgerRepository $accountLedgerRepository)
        {
            $this->accountHeadRepository = $accountHeadRepository;
            $this->accountLedgerRepository = $accountLedgerRepository;
        }

        /**
         * ## Chart of Accounts Table ##
         *
         * Get the All HEADS and LEDGERS of accounts maintaining hierarchy
         * @return string
         */
        public function getAllAccountList()
        {
            $string = '';

            $mainHeads = $this->accountHeadRepository->getMainParentHeads();

            foreach ($mainHeads as $mainHead) {

                $string .= '<tr class="active">' .
                    '<td><strong>' . $mainHead->name . ' ' . $mainHead->code . '</strong></th>' .
                    '<td><strong>Head</strong></td>' .
                    '<td>-</td>' .
                    '<td>&nbsp;</td>' .
                    '</tr>';

                foreach ($ledgers = $this->accountLedgerRepository->getLedgersOfHead($mainHead->id) as $ledger) {

                    $ledgerRowAction = '<div align="center">' .
                        '<a tabindex="-1" href="' . route('account-ledger.edit', $ledger->id) . '" title="Edit" class="popup-link"><i class="la la-pencil-square-o text-info" aria-hidden="true"></i></a>' .
                        //    '<a tabindex="-1" href="' . route('account-ledger.destroy', $ledger->id) . '" title="Delete" onclick="return confirm(\'Sure to delete ?\')"><i class="la la-trash-o text-danger" aria-hidden="true"></i></a>' .
                        '</div>';

                    $string .= '<tr>' .
                        '<td>&nbsp;&nbsp;' . $ledger->name . ' ' . $ledger->code . '</th>' .
                        '<td>Ledger</td>' .
                        '<td>' . $ledger->opening_balance . '</td>' .
                        '<td>' . $ledgerRowAction . '</td>' .
                        '</tr>';
                }

                $string .= $this->getAllChildAccountList($mainHead->id);
            }

            return $string;
        }

        /**
         * @param $head
         * @param string $space
         * @return String
         */
        private function getAllChildAccountList($head, $space = '')
        {
            $string = '';

            $space .= $space . '&nbsp;&nbsp;&nbsp;&nbsp;';

            foreach ($childHeads = $this->accountHeadRepository->getChildHead($head) as $childHead) {
                $headRowAction = '<div align="center">' .
                    '<a tabindex="-1" href="' . route('account-head.edit', $childHead->id) . '" title="Edit" class="popup-link"><i class="la la-edit text-info" aria-hidden="true"></i></a>' .
                    //    '<a tabindex="-1" href="' . route('account-head.destroy', $childHead->id) . '" title="Delete" onclick="return confirm(\'Sure to delete ?\')"><i class="la la-trash-o text-danger" aria-hidden="true"></i></a>' .
                    '</div>';

                $string .= '<tr>' .
                    '<td>' . $space . ' <strong>' . $childHead->name . ' ' . $childHead->code . '</strong></th>' .
                    '<td><strong>Head</strong></td>' .
                    '<td>-</td>' .
                    '<td>' . $headRowAction . '</td>' .
                    '</tr>';

                foreach ($ledgers = $this->accountLedgerRepository->getLedgersOfHead($childHead->id) as $ledger) {

                    $ledgerRowAction = '<div align="center">' .
                        '<a tabindex="-1" href="' . route('account-ledger.edit', $ledger->id) . '" title="Edit" class="popup-link"><i class="la la-pencil-square-o text-info" aria-hidden="true"></i></a>' .
                        //    '<a tabindex="-1" href="' . route('account-ledger.destroy', $ledger->id) . '" title="Delete" onclick="return confirm(\'Sure to delete ?\')"><i class="la la-trash-o text-danger" aria-hidden="true"></i></a>' .
                        '</div>';

                    $string .= '<tr>' .
                        '<td>&nbsp;&nbsp;&nbsp;&nbsp;' . $space . $ledger->name . ' ' . $ledger->code . '</th>' .
                        '<td>Ledger</td>' .
                        '<td>' . $ledger->opening_balance . '</td>' .
                        '<td>' . $ledgerRowAction . '</td>' .
                        '</tr>';
                }

                $string .= $this->getAllChildAccountList($childHead->id, $space);
            }

            return $string;
        }


        /**
         * ## Head Nested Select > Options ##
         *
         * Get the All HEAD of accounts
         * maintaining hierarchy
         * @param int $optionSelectedId null
         * @return string
         */
        public function getAllHeadsOptionList($optionSelectedId = NULL)
        {
            $list = '';

            $mainHeads = $this->accountHeadRepository->getMainParentHeads();

            foreach ($mainHeads as $mainHead) {
                $list .= '<option 
                        value="' . $mainHead->id . '" 
                        data-type="' . $mainHead->head_type . '" ' . $this->isOptionSelected($optionSelectedId, $mainHead->id) . '>' .
                    $mainHead->name .
                    '</option>';
                $list .= $this->getChildHeadOptionList($mainHead->id, '', $optionSelectedId);
            }

            return $list;
        }

        private function getChildHeadOptionList($parentId, $space, $optionSelectedId = NULL)
        {
            $list = '';

            $space .= $space . '&nbsp;&nbsp;&nbsp;&nbsp;';

            foreach ($this->accountHeadRepository->getChildHead($parentId) as $childHead) {
                $list .= '<option 
                        value="' . $childHead->id . '" 
                        data-type="' . $childHead->type . '" ' . $this->isOptionSelected($optionSelectedId, $childHead->id) . '>' .
                    $space . ' ' . $childHead->name .
                    '</option>';

                $list .= $this->getChildHeadOptionList($childHead->id, '', $optionSelectedId);
            }

            return $list;
        }

        private function isOptionSelected($select, $check)
        {
            return $select == $check ? 'selected="selected"' : '';
        }

        /**
         * Import Economic Code and Head
         */

        public function importEconomicCode()
        {
            Excel::import(new ImportEconomicCode(), storage_path('economic_code.xlsx'));
        }

    }
