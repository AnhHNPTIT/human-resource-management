<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/pharmacy-168e9-firebase-adminsdk-xmctx-f6da0d796b.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://pharmacy-168e9.firebaseio.com')
        ->create();

        $database = $firebase->getDatabase();

        $newOrder = $database
        ->getReference('/')
        ->push([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'order_id' => $request->order_id,
            'content' => $request->content,
            'path' => $request->path,
            'is_read' => $request->is_read,
            'created_at' => $request->created_at,
        ]);

        return $newOrder;
    }
}

