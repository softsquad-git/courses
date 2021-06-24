<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string $from
     */
    private string $from;

    /**
     * @var string|array $to
     */
    private string|array $to;

    /**
     * @var string $template
     */
    private string $template;

    /**
     * @var array $body
     */
    private array $body;

    /**
     * @var string $subject
     */
    private string $subject;

    /**
     * @param string $from
     * @param string|array $to
     * @param string $template
     * @param array $body
     * @param string $subject
     */
    public function __construct(
        string $from, string|array $to, string $template, array $body, string $subject
    )
    {
        $this->from = $from;
        $this->to = $to;
        $this->template = $template;
        $this->body = $body;
        $this->subject = $subject;
    }

    /**
     * @return void
     */
    public function handle()
    {
        //
    }
}
