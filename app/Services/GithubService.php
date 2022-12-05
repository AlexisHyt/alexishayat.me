<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{
    private const USERNAME = 'AzenoX';

    public function getRepos(): array
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->get('https://api.github.com/users/' . self::USERNAME . '/repos')
            ->json();
    }

    public function hasNewRepos(): bool
    {
        $actualRequest = json_encode($this->getRepos());
        $actualSave = file_get_contents(public_path('projects.json'));
        return json_decode($actualRequest) != json_decode($actualSave)
            && env('PARSE_GITHUB', false);
    }

    public function getRepoInfos(string $repoName): array
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->get('https://api.github.com/repos/' . self::USERNAME . '/' . $repoName . '/contents/PORTFOLIO_FILE.md')
            ->json();
    }

    public function getRepoLanguages(string $repoName)
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->get('https://api.github.com/repos/' . self::USERNAME . '/' . $repoName . '/languages')
            ->json();
    }
}
