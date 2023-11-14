<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Revolution\Google\Sheets\Facades\Sheets;

class ExportCommentsToGoogleSheets extends Command
{
    protected $signature = 'app:export-comments-to-google-sheets {startDate} {endDate}';

    protected $description = 'Command description';


    public function handle()
    {
        $startDate = Carbon::parse($this->argument('startDate'));
        $endDate = Carbon::parse($this->argument('endDate'));

        $comments = Comment::whereBetween('created_at', [$startDate->toDateString(), $endDate->toDateString()])
            ->with('commentable', 'user')
            ->get();

        foreach ($comments as $comment) {
            Sheets::spreadsheet(config('google.post_spreadsheet_id'))
                ->sheet('data')
                ->append([[
                    $comment->user->name,
                    $comment->content,
                    $comment->commentable_type,
                    $comment->commentable->title ?? $comment->commentable->name,
                    $comment->created_at->toDateTimeString()
                ]]);
        }
    }
}
