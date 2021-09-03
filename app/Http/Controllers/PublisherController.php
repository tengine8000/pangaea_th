<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Topic;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class PublisherController extends Controller
{
    public function publish(Request $request, $topic)
    {
        $topic = Topic::where('topic', strtolower($topic))->first();
        if (!$topic) {
            return response()->json([
                'Error' => 'No such topic',
                'topic' => $topic
            ], 400);
        }

        $subscriptions = Subscription::where('topic_id', $topic->id)->get();
        $subscriber_urls = $subscriptions->map( function ($subscription, $key) use ($topic, $request) {
            try {
                Http::post($subscription->subscriber->url. '/api', [
                    'topic' => $topic->topic,
                    'data' => $request->all()
                ]);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                Log::error($e->getMessage());
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                Log::error($e->getMessage());
            }
            return $subscription->subscriber->url;
        });

        return response()->json([
            'topic' => $topic->topic,
            'topic_id' => $topic->id,
            'subscriber_urls' => $subscriber_urls,
            'data' => $request->all()
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }
}
