<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GithubService;
use Curl\Curl;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Swaggest\JsonSchema\Schema;

class HomeController extends Controller
{
    /**
     * Show home page
     * @throws Exception
     */
    public function index(Request $request, GithubService $githubService)
    {
        $projects = [];

        $logo = [
            'HTML' => [
                'title' => 'html5',
                'color' => '#E34F26',
            ],
            'CSS' => [
                'title' => 'css3',
                'color' => '#1572B6',
            ],
            'JavaScript' => [
                'title' => 'javascript',
                'color' => '#F7DF1E',
            ],
            'PHP' => [
                'title' => 'php',
                'color' => '#777BB4',
            ],
            'SCSS' => [
                'title' => 'sass',
                'color' => '#CC6699',
            ],
            'Dockerfile' => [
                'title' => 'docker',
                'color' => '#2496ED',
            ],
            'Ruby' => [
                'title' => 'ruby',
                'color' => '#CC342D',
            ],
            'Python' => [
                'title' => 'python',
                'color' => '#3776AB',
            ],
            'TypeScript' => [
                'title' => 'typescript',
                'color' => '#3178C6',
            ],
            'Vue' => [
                'title' => 'vuedotjs',
                'color' => '#4FC08D',
            ],
            'Shell' => [
                'title' => '__',
                'color' => '#000',
            ],
            'Twig' => [
                'title' => '__',
                'color' => '#000',
            ],
            'Perl' => [
                'title' => '__',
                'color' => '#000',
            ],
            'Other' => [
                'title' => '__',
                'color' => '#000',
            ],
            'Blade' => [
                'title' => '__',
                'color' => '#000',
            ],
            'Hack' => [
                'title' => '__',
                'color' => '#000',
            ],
        ];

        $repos = $githubService->getRepos();

        if ($githubService->hasNewRepos()) {
            $current_projects = [];

            foreach ($repos as $item) {
                $current_projects[] = $item;

                if (!$item['name']) {
                    continue;
                }
                $repo_name = $item['name'];
                $repo_description = $item['description'] ?? 'No description...';
                $repo_url = $item['html_url'] ?? 'https://github.com/AzenoX';
                $repo_homepage = $item['homepage'];

                $curlDate = $githubService->getRepoInfos($repo_name);

                if (
                    isset($curlDate['response'])
                    && $curlDate['message'] !== 'Not Found'
                    && isset($curlDate['response']['content'])
                ) {
                    $content = base64_decode($curlDate['response']['content']);
                    $date = explode('_', $content)[0];
                    $type = explode('_', $content)[1] ?? 'website';

                    if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $date)) {
                        $curlLangs = $githubService->getRepoLanguages($repo_name);

                        //Get all lang icons
                        $langs = [];
                        foreach ($curlLangs['response'] as $lang => $value) {
                            $langs[] = [
                                'title' => $logo[$lang]['title'],
                                'color' => $logo[$lang]['color']
                            ];
                        }

                        //Get months since the beginning of the project
                        $date_created = new DateTime($date);
                        $date_now = new DateTime();

                        $months = $date_created->diff($date_now)->m;

                        //Create project data
                        $project = json_encode([
                            'name' => $repo_name,
                            'description' => $repo_description,
                            'url' => $repo_url,
                            'homepage' => $repo_homepage,
                            'langs' => $langs,
                            'months' => $months,
                            'date_created' => $date_created,
                            'type' => $type
                        ]);
                        $projects[] = json_decode($project);
                    }
                }
            }

            //Sort projects
            usort($projects, function ($a, $b){
                $dateA = DateTime::createFromFormat('Y-m-d H:i:s.u', $a->date_created->date);
                $dateB = DateTime::createFromFormat('Y-m-d H:i:s.u', $b->date_created->date);

                return ($dateA->getTimestamp() - $dateB->getTimestamp()) * -1;
            });

            //Save projects
            file_put_contents(public_path('projects.json'), json_encode($current_projects));
            file_put_contents(public_path('projects_built.json'), json_encode($projects));

            $projects = json_encode($projects);

        }
        else{
            $projects = file_get_contents(public_path('projects_built.json'), true);
        }

        $technos = file_get_contents(public_path('technos.json'), true);

        return view('home', [
            'projects' => $projects,
            'technos' => $technos,
            'firstItemId' => array_key_first((Array)json_decode($technos)->logos),
        ]);
    }
}
