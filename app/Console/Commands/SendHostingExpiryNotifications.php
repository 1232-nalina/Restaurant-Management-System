<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\HostingExpiryNotification;
use App\Models\Hosting;
use Illuminate\Support\Facades\Log;

class SendHostingExpiryNotifications extends Command
{
    protected $signature = 'send:notifications';

    protected $description = 'Send hosting expiry notifications to clients.';

    public function handle()
    {
        // Get all clients whose hosting is expiring in the next 15, 7 and 2 days respectively
        $hostings = Hosting::whereBetween('expiry_date', [Carbon::now(), Carbon::now()->addDays(15)])
        ->with('client')
        ->get();
                        Log::info($hostings);

        // Send notifications to clients
        foreach ($hostings as $client) {
            $expiryDate = Carbon::parse($client->expiry_date);
            $daysRemaining = $expiryDate->diffInDays(Carbon::now());
            $finalcount=$daysRemaining+1;
            Log::info($finalcount);

            if (filter_var($client->client->email, FILTER_VALIDATE_EMAIL) && $finalcount === 15) {
                Mail::to($client->client->email)->send(new HostingExpiryNotification($client));
                Log::info('mail sent');
            }
            if (filter_var($client->client->email, FILTER_VALIDATE_EMAIL) && $finalcount === 7) {
                Mail::to($client->client->email)->send(new HostingExpiryNotification($client));
                Log::info('mail sent');
            }
            if (filter_var($client->client->email, FILTER_VALIDATE_EMAIL) && $finalcount === 2) {
                Mail::to($client->client->email)->send(new HostingExpiryNotification($client));
                Log::info('mail sent');
            }
        }

        Log::info('Hosting expiry notifications sent successfully.');
    }
}
