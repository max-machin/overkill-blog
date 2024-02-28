# overkill-blog

## Design Pattern

### 1. Proxy

Le design pattern **proxy** va permettre de mettre en place un système de mise en cache.

Classe exemple : src/Controller/Post/PostController.php
```
PostController->getPaginatedPosts()
{
    // logic go here ....
    RenderProxy->display()
} 
```
- Possible de retrouver les exemples en recherchant : 'proxy'

### 2. Façade 

La **façade** va permettre de regrouper une logique multiple en un service faisant office de manager.

Classe exemple : App\Facade\AuthenticationFaçade


Voir pour le decorator, composite, chaine de responsabilité, iterator ? 

Voir pour factory avec le Crud et pour façade avec les manager ou les controllers ? 

Voir pour la présentation du proxy par rapport à de potentielles images dans les articles par la suite ou pour faire de la mise en cache éventuelle.