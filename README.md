# overkill-blog

## Design Pattern

### 1. Proxy

Le design pattern **proxy** va permettre de mettre en place un système de mise en cache.

Classe exemple : App\Classes\Render 
```
PostController->getPaginatedPosts()
{
    // logic go here ....
    RenderProxy->display()
} 
```