<?php
namespace src\handlers;

use \src\models\Post;
use src\models\PostComment;
use \src\models\User;
use \src\models\UserRelation;
use \src\models\PostLike;

class PostHandler {

    public static function addPost(int $idUser, string $type, string $body) {
        $body = trim($body);
        
        if(!empty($idUser) && !empty($body)) {

            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body
            ])->execute();

        }
    }

    public static function _postListToObject($postList, $loggedUserId) {
        $posts = [];
        
        // Transformando em objeto
        foreach($postList as $postItem) {
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->created_at = $postItem['created_at'];
            $newPost->body = $postItem['body'];
            $newPost->mine = false;

            if($postItem['id_user'] == $loggedUserId) {
                $newPost->mine = true;
            }

            // Pegando mais informações do post
            // Informações do usuário que fez o post... nome, avatar, número de likes do post, comentários...
            $newUser = User::select()
                ->where('id', $postItem['id_user'])
            ->one();

            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];

            // Todo -> Pegando Likes
            $likes = PostLike::select()->where('id_post', $postItem['id'])->get();

            $newPost->likeCount = count($likes);
            $newPost->liked = self::isLiked($postItem['id'], $loggedUserId);

            // Todo -> Pegando comentarios
            $newPost->comments = PostComment::select()->where('id_post', $postItem['id'])->get();
            // Adicionar informações do usuário que fez o comentário dentro do array de comentários
            foreach($newPost->comments as $key => $comment) {
                $newPost->comments[$key]['user'] = User::select()->where('id', $comment['id_user'])->one();
            }

            $posts[] = $newPost;
        }

        return $posts;
    }

    public static function isLiked($id, $loggedUserId) {
        $myLike = PostLike::select()
            ->where('id_post', $id)
            ->where('id_user', $loggedUserId)
        ->get();

        if(count($myLike) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserFeed(int $idUser, int $page, int $loggedUserId) {
        $perPage = 10;

        $postList = Post::select()
            ->where('id_user', $idUser)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
        ->get();

        $total = Post::select()->where('id_user', $idUser)->count();
        $pageCount = ceil($total / $perPage);

        // print_r($posts);
        // Transformando posts em objetos com informações do usuário inclusas.
        $posts = self::_postListToObject($postList, $loggedUserId);

        return [
            'posts' => $posts,
            'pageCount' => $pageCount,
            'currentPage' => $page
        ];
    }

    public static function getHomeFeed(int $idUser, int $page) {
        $perPage = 10;

        // Pegando lista de usuários que o usuário logado segue.
        $userList = UserRelation::select()->where('user_from', $idUser)->get();

        $users = [];
        foreach($userList as $userItem) {
            $users[] = $userItem['user_to'];
        }
        // Adicionando o usuário logado na lista de usuários para pegar os posts dos usuários que o usuário logado segue
        // Pegar também os posts do usuário logado.
        $users[] = $idUser;

        // print_r($users);

        // Pegando todos os posts da lista de usuários, incluindo os posts do usuário logado.
        $postList = Post::select()
            ->where('id_user', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
        ->get();

        $total = Post::select()->where('id_user', 'in', $users)->count();
        $pageCount = ceil($total / $perPage);

        // print_r($posts);
        // Transformando posts em objetos com informações do usuário inclusas.
        $posts = self::_postListToObject($postList, $idUser);

        return [
            'posts' => $posts,
            'pageCount' => $pageCount,
            'currentPage' => $page
        ];
    }

    public static function getPhotosFrom(int $idUser) {
        $photosData = Post::select()
            ->where('id_user', $idUser)
            ->where('type', 'photo')
        ->get();

        $photos = [];

        foreach($photosData as $photo) {
            $newPost = new Post();
            $newPost->id = $photo['id'];
            $newPost->type = $photo['type'];
            $newPost->created_at = $photo['created_at'];
            $newPost->body = $photo['body'];

            $photos[] = $newPost;
        }

        return $photos;
    }

    public static function deleteLike(int $id, int $loggedUserId) {
        PostLike::delete()
            ->where('id_post', $id)
            ->where('id_user', $loggedUserId)
        ->execute();
    }

    public static function addLike(int $id, int $loggedUserId) {
        PostLike::insert([
            'id_post' => $id,
            'id_user' => $loggedUserId,
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }

    public static function addComment(int $id, string $txt, int $loggedUserId) {
        PostComment::insert([
            'id_post' => $id,
            'id_user' => $loggedUserId,
            'created_at' => date('Y-m-d H:i:s'),
            'body' => $txt
        ])->execute();
    }

    public static function delete(int $id, int $loggedUserId) {
        // Verificar se o post existe e pertence ao usuário logado;
        $post = Post::select()
            ->where('id', $id)
            ->where('id_user', $loggedUserId)
        ->get();

        if(count($post) > 0) {
            $post = $post[0];

            // Deletando likes e comentários do post;
            PostLike::delete()->where('id_post', $id)->execute();
            PostComment::delete()->where('id_post', $id)->execute();

            // Se o post for do tipo photo, delete o arquivo do servidor;
            if($post['type'] == 'photo') {
                $img = __DIR__.'/../../public/media/uploads/'.$post['body'];
                if(file_exists($img)) {
                    unlink($img);
                }
            }

            // Deletando o post;
            Post::delete()->where('id', $id)->execute();
        }
    }

}