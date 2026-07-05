<?php 

class NotificationService
{
    public function notification(string $audioKey, string $title)
    {
        $this->logger->info("Nouvel enregistrement créé : $audioKey pour la story $title");
    }
}

?> 