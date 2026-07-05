<?php 

use Psr\Log\LoggerInterface;

class NotificationService
{
    public function __construct(
        private LoggerInterface $logger
    )
    {} 

    public function notifier(string $audioKey, string $title)
    {
        $this->logger->info("Nouvel enregistrement créé : $audioKey pour la story $title");
    }
}

?> 