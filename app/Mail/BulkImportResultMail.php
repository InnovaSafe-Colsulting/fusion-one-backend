<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BulkImportResultMail extends Mailable
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
        return new Envelope(subject: 'Resultado importación masiva de productos');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.bulk-import-result');
    }

    public function attachments(): array
    {
        if ($this->errorFilePath && Storage::exists($this->errorFilePath)) {
            return [
                Attachment::fromStorage($this->errorFilePath)
                    ->as('errores_importacion.xlsx')
                    ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            ];
        }

        return [];
    }
}
