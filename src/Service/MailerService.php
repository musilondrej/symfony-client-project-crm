<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailerService
{
    public function __construct(
        private MailerInterface $mailer,
        #[Autowire('%app.mailer.from_address%')] private string $fromAddress,
        #[Autowire('%app.mailer.from_name%')] private string $fromName,
    ) {
    }

    public function send(string $to, string $subject, string $template, array $context = []): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->fromAddress, $this->fromName))
            ->to($to)
            ->subject($subject)
            ->htmlTemplate($template)
            ->context($context);

        $this->mailer->send($email);
    }
}
