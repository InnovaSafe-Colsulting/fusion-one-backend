<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BulkImportVariantResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string  $userName,
        public int     $registersOk,
        public int     $errorsCount,
        public ?string $errorFilePath,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Resultado importación masiva de variantes');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.bulk-import-variant-result');
    }

    public function attachments(): array
    {
        if ($this->errorFilePath && Storage::exists($this->errorFilePath)) {
            return [
                Attachment::fromStorage($this->errorFilePath)
                    ->as('errores_variantes.xlsx')
                    ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            ];
        }
        return [];
    }
}
