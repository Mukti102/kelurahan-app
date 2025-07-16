<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsAppNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userPhone;
    protected $message;


    /**
     * Create a new job instance.
     */
    public function __construct($userPhone, $message)
    {
        $this->userPhone = $userPhone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Kirim WA menggunakan API Gateway (sesuaikan dengan endpoint API-mu)
        try {
            $this->sendMessageToWa($this->userPhone, $this->message);
        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp notification: ' . $e->getMessage());
        }
    }

    public function sendMessageToWa($userPhone, $pesan)
    {
        if (strpos($userPhone, '0') === 0) {
            $userPhone = '62' . substr($userPhone, 1);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.kedaiwa.biz.id/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => env("WA_APP_KEY"),
                'authkey' => env('WA_AUTH_KEY'),
                'to' => $userPhone,
                'message' => $pesan,
                'sandbox' => 'false'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
