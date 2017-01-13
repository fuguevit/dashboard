<?php

namespace App\Components\GitHub;

use App\Events\GitHub\FileContentFetched;
use GitHub;
use Illuminate\Console\Command;

class FetchGitHubFileContent extends Command
{
    protected $signature = 'dashboard:github';
    
    protected $description = 'Fetch GitHub file content.';
    
    public function handle()
    {
        $fileNames = explode(',', env('GITHUB_FILES'));
        
        $fileContent = collect($fileNames)
            ->combine($fileNames)
            ->map(function ($fileName) {
                return GitHub::repo()->contents()->show('fuguevit', 'tasks', "{$fileName}.md", 'master');
            })
            ->map(function ($fileInfo) {
                return file_get_contents($fileInfo['download_url']);
            })
            ->map(function ($markdownContent) {
                return markdownToHtml($markdownContent);
            })
            ->toArray();
        
        event(new FileContentFetched($fileContent));
    }
}
