Lancer le projet : symfony server:start
Créer la base : php bin/console doctrine:database:create
Jouer la migration : php bin/console doctrine:migrations:migrate

Je n'ai pas eu le temps de faire les bonus : 
1) Filtre sur title : GetCollection avec en paramètre le titre sur lequel on applique un PartialSearchFilter (à l'aide de la documentation API Platform) 
2) TestPHPUnit : on crée un objet Recording, on exécute le RecordingProcessor sur cet objet et on vérifie qu'audioKey n'est pas null 
3) Validation : dans le RecordingProcessor, get le narrator et l'ean, vérifier avec un Assert\NotBlank() et un Assert\Length(min: 13, max: 13) puis set
4) Timestampable : créer le Trait Timestampable avec getCreatedAt et setCreatedAt à l'intérieur
