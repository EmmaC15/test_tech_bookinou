<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

// ajout de l'entité, le service et l'autowire 
use App\Entity\Recording;
use App\Service\NotificationService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;


class RecordingProcessor implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor,
        private NotificationService $notificationService
    )
    {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Recording
    {
        $audioKey = $data->getAudioKey(); // comment je convertis audioKey en uuid ? 
        $data->setAudioKey($audioKey);

        $title = $data->getStory(getTitle()); // ça fonctionne, ça ? 

        $notificationService.notify($audioKey, $title);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
        
    }
}
