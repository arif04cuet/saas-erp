
<div class="card">
    <div class="card-header">
        <div class="head-title bold">
            {{__('tms::annual_training.email_content.initials', ['url' => $url])}}
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="preview_email_content">
            <table style="border: none">
                <!-- Email Subject -->
                <tr style="border: none">
                    <td style="border: none">
                        <p>
                            <strong>  {{__('tms::annual_training.email_content.subject')}}</strong>
                        </p>
                    </td>
                </tr>
                <tr style="border: none">
                    <td style="border: none">
                        <!-- Email Body -->
                        <p style="text-align: justify">
                            <strong>Dear Sir</strong>
                            <br>
                            Bangladesh Academy for Rural Development (BARD) is going to organize its Annual Planning
                            Conference for evaluating its performance of previous year and formulating its plan for next years. In this
                            connection it will be highly appreciated if you kindly let us know your plan to organise training course at
                            BARD during July <i id="start_year"></i> to June <i id="end_year"></i> by filling the following format. You are also requested to send your
                            demand by <strong id="response_date"></strong>
                        </p>
                    </td>
                </tr>
            </table>

            <!-- Table for demand entry -->
            <table style="border: 1px solid gray; border-collapse: collapse">
                <tr style="border: 1px solid gray; border-collapse: collapse; height: 40px">
                    <th style="border: 1px solid gray; border-collapse: collapse">Sl No</th>
                    <th style="border: 1px solid gray; border-collapse: collapse">Name of Training Course</th>
                    <th style="border: 1px solid gray; border-collapse: collapse">No. of Participants</th>
                    <th style="border: 1px solid gray; border-collapse: collapse">Nature of Participants</th>
                    <th colspan="3" style="border: 1px solid gray; border-collapse: collapse">Tentative Schedule</th>
                    <th style="border: 1px solid gray; border-collapse: collapse">Comments (if any)</th>
                </tr>
                <tr style="border: 1px solid gray; border-collapse: collapse; height: 60px">
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                </tr>
                <tr style="border: 1px solid gray; border-collapse: collapse; height: 60px">
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                    <td style="border: 1px solid gray; border-collapse: collapse"></td>
                </tr>
            </table>

            <!-- Email Footer -->
            <table style="border: none; width: 100%">
                <tr style="border: none">
                    <td style="border: none">
                        <p>
                            <strong>@lang('tms::annual_training.email_content.footer')</strong>
                        </p>
                    </td>
                </tr>
                <tr style="border: none">
                    <td style="border: none"><hr></td>
                </tr>
                <tr style="border: none">
                    <td style="text-align: right; border: none">
                        Your Sincerely,<br>
                        Director Training
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
