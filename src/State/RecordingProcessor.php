<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface; 

// ajout de l'entité, le service et l'autowire et l'uuid 
use App\Entity\Recording;
use App\Service\NotificationService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Uid\Uuid;



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
        $uuid = Uuid::uuid4();
        $audioKey = $uuid->toString();
        $data->setAudioKey($audioKey);

        $date_now = new \DateTime();
        $data->setCreatedAt($date_now);

        $story = $data->getStory(); 
        $title = $story->getTitle();

        $this->notificationService->notifier($audioKey, $title);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
        
    }
}
