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


### 3. Chaine de responsabilité

Le design pattern **chaine de responsabilité** va créer un fonctionnement commun entre différent service.
Dans cet exemple, un processus de validation des données lors de l'inscription.

Classe exemple : src/Authentication/Validate.php
```
Validate->isValid($postEntries)
{
    $this->sanitizeValidationHandler->setNextHandler($this->mailValidationHandler);
    $this->mailValidationHandler->setNextHandler($this->passwordValidationHandler);

    $this->sanitizeValidationHandler->handlerRequest($data);
} 
```
- Possible de retrouver les exemples en recherchant : 'chaine de responsabilite'

### 4. Iterator

Le design pattern **Iterator** va permettre de traverser une collection d'objet.

Classe exemple : src/Iterator/IteratorManager.php
                 src/Iterator/Post/PostCollection.php
```
PostInformations->getPaginatedPosts()
{
    // Collection de commentaires
    $commentsCollection = new CommentCollection();

    // Boucle sur les commentaires du post
    foreach((new Comment())->findByPost($iterator->current()['id']) as $comment){
        $commentsCollection->addItem($comment);
    }

    $commentIterator = $commentsCollection->getIterator();
    $comments = [];

    // Validation des items de la collection
    while($commentIterator->valid())
    {
        $comments[] = $commentIterator->current();
        $commentIterator->next();
    }
    
    // Set des comments du post
    $post->setComments($comments);
} 
```
- Possible de retrouver les exemples en recherchant : 'iterator'


