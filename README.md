#Installation du projet

Apres le clone du projet  

    composer install
    
Dans .env modifier les parametre de connexion a la base de donnee(user / et password)

    php bin/console doc:dat:create
    php bin/console make:migration
    php bin/console doc:mig:mig

Creation des donnee depuis fixtures
    
    php bin/console doc:fix:load
    
Il y a un test unitaire sur la connexion d'un auteur, pour lancer cela

    php bin/phpunit tests/AppTest
    
    