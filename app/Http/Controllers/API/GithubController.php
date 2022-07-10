<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Curl\Curl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GithubController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function repoCount(Request $request): JsonResponse
    {
        $count = Cache::remember('repo_count', 60*60*24*7, function () {
            $response = Http::withToken(env('GITHUB_TOKEN'))
                ->get('https://api.github.com/users/AzenoX/repos');
            $response = collect($response->json())
                ->filter(function ($e) {
                    return !$e['private'];
                });
            return $response->count();
        });

        return new JsonResponse([
            'schemaVersion' => 1,
            'label' => 'repositories',
            'message' => strval($count),
            'color' => 'brightgreen'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function lang(): JsonResponse
    {
        return new JsonResponse([
            'schemaVersion' => 1,
            'label' => 'Main Language',
            'message' => 'PHP',
            'color' => '777BB4'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function countCommits(): JsonResponse
    {
        $commitCount = Cache::remember('commits_count', 60*60*24*7, function () {
            $curl = new Curl();
            $curl->setHeader('Authorization', 'Bearer ' . env('GITHUB_TOKEN'));
            $curl->get('https://api.github.com/users/AzenoX/repos');

            $commit = 0;

            foreach ($curl->response as $repo) {
                if (!$repo->name) {
                    continue;
                }

                $curlCommit = new Curl();
                $curlCommit->setHeader('Authorization', 'Bearer ' . env('GITHUB_TOKEN'));
                $curlCommit->get('https://api.github.com/repos/AzenoX/' . $repo->name . '/commits');

                $commit += count($curlCommit->response);
            }

            return $commit;
        });

        return new JsonResponse([
            'schemaVersion' => 1,
            'label' => 'All Time Commits',
            'message' => strval($commitCount),
            'color' => 'orange'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function portfolio(): JsonResponse
    {
        return new JsonResponse([
            'schemaVersion' => 1,
            'label' => 'Visit my portoflio',
            'message' => '➜',
            'color' => 'orange',
            'link' => 'https://alexishayat.me/'
        ]);
    }
}
