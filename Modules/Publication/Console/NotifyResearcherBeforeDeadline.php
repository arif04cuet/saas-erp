<?php

namespace Modules\Publication\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Publication\Entities\PublishedResearchPaperComment;
use Modules\Publication\Services\PublishedResearchPaperService;
use Modules\Publication\Services\PublicationRequestService;

class NotifyResearcherBeforeDeadline extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'notify:researcher-before-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        PublicationRequestService $publicationRequestService,
        PublishedResearchPaperService $publishedResearchPaperService
    ) {
        parent::__construct();
        $this->publicationRequestService = $publicationRequestService;
        $this->publishedResearchPaperService = $publishedResearchPaperService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $comments = PublishedResearchPaperComment::get();
        foreach ($comments  as $comment) {

            $deadline = $this->getProofDeadline($comment);
            if ($deadline) {
                $this->notifyResearcher($comment, $deadline);
            }
        }
    }

    private function getProofDeadline(PublishedResearchPaperComment $comment)
    {
        $date = $comment->last_date;

        if (!is_null($date)) {
            $date = Carbon::parse($date);
            return $date;
        }
        return null;
    }

    private function notifyResearcher(PublishedResearchPaperComment $comment, $date)
    {
        $today = Carbon::today();

        if ($date->diffInDays($today) > 1) {
            return;
        }
        $proofStatus = $comment->publishedResearch->proof_status;
        if ($proofStatus == $comment->action) {
            $publishedResearchPaper = $comment->publishedResearch;
            $id =  $comment->publishedResearch->publicationRequest->research->submitted_by;
            $message = $this->publishedResearchPaperService->getProofStatusMessage($proofStatus);
            $url = "publication.published-research-papers.show";
            $this->publicationRequestService->sendDeadlineNotification($publishedResearchPaper, $id, $message, $url);
        }
    }
}
