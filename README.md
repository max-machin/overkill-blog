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
L'exemple illustrant ce design pattern s'articule autour de l'authentication. La façade sera chargée de valider les entrées du formulaire, inscrire l'utilisateur, le connecter et lui faire savoir via un mail qu'il est inscrit.

Classe exemple : src/Facade/Authentication/AuthenticationFacade.php
```
AuthenticationFacadeController->signUpNewUser()
{
    // logic go here ....
    $facade = new AuthenticationFacade($validate, $auth, $mail);
    $rep = $facade->signUpUser($email, $password, $confirmPassword, $firstname, $lastname);
} 
```
- Possible de retrouver les exemples en recherchant : 'facade'







Valider façade et proxy.

Handler error -> chaine de responsabilité
Voir pour le decorator, composite, chaine de responsabilité, iterator ? 

Voir pour factory avec le Crud et pour façade avec les manager ou les controllers ? 

Voir pour la présentation du proxy par rapport à de potentielles images dans les articles par la suite ou pour faire de la mise en cache éventuelle.