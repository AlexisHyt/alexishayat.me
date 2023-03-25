<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{
    private const USERNAME = 'AzenoX';
    private const GITHUB_API_VERSION = "2022-11-28";

    public function getRepos(): array
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->withHeaders([
                'X-GitHub-Api-Version' => self::GITHUB_API_VERSION,
            ])
            ->get('https://api.github.com/users/' . self::USERNAME . '/repos?per_page=100')
            ->json();
    }

    public function hasNewRepos(): bool
    {
        $actualRequest = json_encode($this->getRepos());
        $actualSave = file_get_contents(public_path('projects.json'));
        return json_decode($actualRequest) != json_decode($actualSave)
            && env('PARSE_GITHUB', false);
    }

    public function getRepoInfos(string $repoName): string|null
    {
        $response = Http::withToken(env('GITHUB_TOKEN'))
            ->withHeaders([
                'X-GitHub-Api-Version' => self::GITHUB_API_VERSION,
            ])
            ->accept('application/vnd.github.raw')
            ->get('https://api.github.com/repos/' . self::USERNAME . '/' . $repoName . '/contents/PORTFOLIO_FILE.md')
            ->body();

        if (!$response || (is_array($response) && $response['message'] === 'Not Found')) {
            return null;
        }

        return $response;
    }

    public function getRepoLanguages(string $repoName)
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->withHeaders([
                'X-GitHub-Api-Version' => self::GITHUB_API_VERSION,
            ])
            ->get('https://api.github.com/repos/' . self::USERNAME . '/' . $repoName . '/languages')
            ->json();
    }
}
