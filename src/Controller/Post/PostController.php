<?php 

namespace App\Controller\Post;

use App\Class\Controller;
use App\Class\Crud;
use App\Class\Post;
use App\Classes\Post\PostInformations;
use App\Proxy\Render\RenderProxy;
use App\Manager\Post\PostManager;

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
        // $renderProxy->display('posts', ['posts' => $posts, 'pages' => $pages]);
    }

    // exemple de façade ? 
    public function viewPost(RenderProxy $renderProxy, $id, $error = null){

        if (is_numeric($id) === false) {
            throw new \Exception("L'identifiant du post n'est pas valide");

            return;
        }

        $postInformations = new PostInformations();

        // Exemple de proxy ? 
        $postManager = new PostManager();

        $post = $postManager->getPostInformations($postInformations, 'id', $id);
        
        $proxy = new RenderProxy('post', ['post' => $post, 'error' => $error]);
        $renderProxy->display();
    }
}

?>