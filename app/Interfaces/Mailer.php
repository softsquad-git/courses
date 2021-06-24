<?php

namespace App\Interfaces;

interface Mailer
{
    /**
     * @param array $attachments
     * @return array
     */
    public function setAttachments(array $attachments): array;

    /**
     * @param string $from
     * @param string|array $to
     * @param array $body
     * @param string $template
     * @param string $subject
     * @return $this
     */
    public function send(
        string $from,
        string|array $to,
        array $body,
        string $template,
        string $subject
    ): self;
}
