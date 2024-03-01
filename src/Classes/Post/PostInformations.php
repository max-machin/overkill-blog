<?php

namespace App\Classes\Post;

use App\Class\Category;
use App\Class\Comment;
use App\Class\Crud;
use App\Class\Post;
use App\Class\User;
use App\Interfaces\Post\PostInformationsInterface;
use App\Iterator\Comment\CommentCollection;
use App\Iterator\Post\PostCollection;
use DateTime;

/**
 * Class PostInformations : Va permettre de retourner les informations des posts.
 * Exemple illustrant le design pattern : iterator
 */
class PostInformations extends Post implements PostInformationsInterface 
{

    public function __construct()
    {
        $this->crud = new Crud('post');
    }

    public function getPostInformations($key, $value)
    {
        $post = $this->crud->GetByAttributes([$key => $value]);

        $this->setId($post[0]['id']);
        $this->setTitle($post[0]['title']);
        $this->setContent($post[0]['content']);
        $this->setCreatedAt($post[0]['created_at'] ? new DateTime($post[0]['created_at']) : null);
        $this->setUpdatedAt($post[0]['updated_at'] ? new DateTime($post[0]['updated_at']) : null);

        // Relations
        $postRelationsInformations = new PostRelationsInformations();
        // User
        $userPost = $postRelationsInformations->getUserPostInformations($post[0]['user_id']);
        $this->setUser($userPost);

        // Category
        $categoryPost = $postRelationsInformations->getCategoryPostInformations($post[0]['category_id']);
        $this->setCategory($categoryPost);

        // Comments
        $comments = $postRelationsInformations->getCommentsPostInformations($post[0]['id']);
        $this->setComments($comments);

        return $this;
    }

    public function getPaginatePosts($page)
    {
        $arrayPosts = $this->crud->GetAllPaginate($page);

        // New collection de Posts
        $newPostCollection = new PostCollection();

        // Boucle sur les posts pour former la collection
        foreach($arrayPosts as $result)
        {
            $newPostCollection->addItem($result);
        }

        $iterator = $newPostCollection->getIterator();

        $results = [];

        // Boucle sur les entités valide selon l'iterator
        while($iterator->valid())
        {
            // Set des values de l'objet
            $post = new Post();
            $post->setId($iterator->current()['id']);
            $post->setTitle($iterator->current()['title']);
            $post->setContent($iterator->current()['content']);
            $post->setCreatedAt(new DateTime($iterator->current()['created_at']));
            $post->setUpdatedAt($iterator->current()['updated_at'] ? new DateTime($iterator->current()['updated_at']) : null);
            $post->setUser((new User())->findOneById($iterator->current()['user_id']));
            $post->setCategory((new Category())->findOneById($iterator->current()['category_id']));

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

            // Remise à 0 de l'index de l'iterator
            $commentIterator->rewind();

            $results[] = $post;

            // objet suivant
            $iterator->next();
        }

        // Remise à 0 de l'index de l'iterator
        $iterator->rewind();

        return $results;
    }
}

?>