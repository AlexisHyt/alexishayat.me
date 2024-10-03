<?php

namespace App\Console\Commands;

use App\Services\GithubService;
use DateTime;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GithubCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull github repositories and update files if new one are detected';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GithubService $githubService
     * @return int
     * @throws Exception
     */
    public function handle(GithubService $githubService): int
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
            'Blade' => [
                'title' => 'laravel',
                'color' => '#FF2D20',
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
//            'Shell' => [
//                'title' => 'powershell',
//                'color' => '#21B352',
//            ],
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

                $portfolioFileContent = $githubService->getRepoInfos($repo_name);

                if ($portfolioFileContent) {
                    $date = explode('_', $portfolioFileContent)[0];
                    $type = explode('_', $portfolioFileContent)[1] ?? 'website';
                    $base64image = explode('_', $portfolioFileContent)[2] ?? null;

                    if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $date)) {
                        $curlLangs = $githubService->getRepoLanguages($repo_name);

                        //Get all lang icons
                        $langs = [];
                        foreach ($curlLangs as $lang => $value) {
                            if (isset($logo[$lang])) {
                                $langs[] = [
                                    'title' => $logo[$lang]['title'],
                                    'color' => $logo[$lang]['color']
                                ];
                            } else {
                                Log::debug('Missing logo for: ' . $lang);
                            }
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
                            'type' => $type,
                            'image' => $base64image
                        ]);
                        $projects[] = json_decode($project);
                    }
                }
            }

            //Sort projects
            usort($projects, function ($a, $b) {
                $dateA = DateTime::createFromFormat('Y-m-d H:i:s.u', $a->date_created->date);
                $dateB = DateTime::createFromFormat('Y-m-d H:i:s.u', $b->date_created->date);
                return ($dateA->getTimestamp() - $dateB->getTimestamp()) * -1;
            });

            //Save projects
            file_put_contents(public_path('projects.json'), json_encode($current_projects));
            file_put_contents(public_path('projects_built.json'), json_encode($projects));
        }

        // Log in console
        $this->info('Pulled ' . count($projects) . ' projects.');

        return 1;
    }
}
