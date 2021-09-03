<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subscriber;
use App\Models\Subscription;

class SubscriberController extends Controller
{
    public function subscribe(Request $request, $topic)
    {
        $validatedData = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $topic = Topic::firstOrCreate(['topic' => strtolower($topic)]);
        $subscriber = Subscriber::firstOrCreate(['url' => strtolower($validatedData['url'])]);

        if(!Subscription::where('topic_id', $topic->id)
        ->where('subscriber_id', $subscriber->id)->exists()){
            Subscription::create([
                'topic_id' => $topic->id,
                'subscriber_id' => $subscriber->id,
            ])->save();
        }

        return response()->json([
            'url' => $validatedData['url'],
            'topic' => $topic->topic,
        ],200,[],JSON_UNESCAPED_SLASHES);
    }

    public function unsubscribe(Request $request, $topic)
    {
        $validatedData = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $topic = Topic::firstOrCreate(['topic' => strtolower($topic)]);
        $subscriber = Subscriber::where(['url' => strtolower($validatedData['url'])])->first();

        if(Subscription::where([
            'topic_id' => $topic->id, 
            'subscriber_id' => $subscriber->id])->exists()){

            Subscription::where([
                'topic_id' => $topic->id,
                'subscriber_id' => $subscriber->id,
            ])->delete();

            return response()->json([
                'message' => 'You have been unsubscribed from this topic!'
            ]);

        }else{
            return response()->json([
                'message' => 'You are not subscribed to this topic!'
            ]);
        }
    }

    public function unsubscribeAll(Request $request)
    {
        $validatedData = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $subscriber = Subscriber::where(['url' => strtolower($validatedData['url'])])->first();
        if(!$subscriber){
            return response()->json([
                'message' => 'Subscriber does not exist!'
            ]);
        }

        // Get all Subscriptions and delete them
        $subscriptions = Subscription::where(['subscriber_id' => $subscriber->id])->get();
        foreach($subscriptions as $subscription){
            $subscription->delete();
        }

        $subscriber->delete();

        return response()->json([
            'message' => 'Subscriber account has been deleted!'
        ]);
    }
}
