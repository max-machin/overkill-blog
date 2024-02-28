<?php 

namespace App\Controller\Post;

use App\Class\Controller;
use App\Class\Crud;
use App\Class\Post;
use App\Classes\Post\PostInformations;
use App\Interfaces\Render\RenderInterface;
use App\Manager\Post\PostManager;

// Proxy 
use App\Proxy\Render\RenderProxy;


class PostController extends Controller
{
    public function getPaginatePosts($page){

        $postInformations = new PostInformations();

        $postManager = new PostManager();

        $postCrud = new Crud('post');

        $postsNumber = $postCrud->GetAll();

        $posts = $postManager->getPaginatePosts($postInformations, $page);
        $pages = count($postsNumber) / 10;

        $proxy = new RenderProxy( 'posts', ['posts' => $posts, 'pages' => $pages]);
        $proxy->display();
    }

    // exemple de façade ? 
    public function viewPost( $id, $error = null){

        if (is_numeric($id) === false) {
            throw new \Exception("L'identifiant du post n'est pas valide");

            return;
        }

        $postInformations = new PostInformations();

        $postManager = new PostManager();

        $post = $postManager->getPostInformations($postInformations, 'id', $id);
        
         // Exemple de proxy ? 
        $proxy = new RenderProxy('post', ['post' => $post, 'error' => $error]);
        $proxy->display();
    }
}

?>