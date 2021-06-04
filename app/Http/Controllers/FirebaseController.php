<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use MrShan0\PHPFirestore\FirestoreClient;



class FirebaseController extends Controller
{
    public function index()
    {
        $v = Helper::getToken('NWM3l6oFjNhi86dT8hJQSycMI2d2');
        dd($v);
        $channelName = $v;
        $recipient = $v;

        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();

        // Subscribe the recipient to the server
        $expo->subscribe($channelName, $recipient);

        // Build the notification data
        $notification = [
            'head' => 'antrian anda',
            'body' => 'antrian sekarang U-Dokter-03 '
        ];

        // Notify an interest with a notification
        $expo->notify([$channelName], $notification);
    }


    // public function update()
    // {
    //     $factory = new FirestoreClient('azzahra-klinik', 'AIzaSyB7hFgej7jCx0cQoaPbe4YvyexbVmcS4WQ', [
    //         'database' => '(default)',
    //     ]);

    //     $factory->updateDocument('antrian/1', [
    //         'dokter' => 'dr faisal',
    //         'no' => 'U-dr faisal-003',
    //         'status' => false,
    //     ]);
    // }
}
