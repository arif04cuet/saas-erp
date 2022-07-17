<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Description of MailSender
 *
 * @author jahangir
 */
trait MailSender
{
    public function sendEmail($toAddress, Mailable $mailable)
    {
        try {
            Mail::to($toAddress)->send($mailable);
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }

}
