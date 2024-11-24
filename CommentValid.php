<?php
namespace App;
require_once __DIR__ . '/vendor/autoload.php';
use App\Entity\Comment;
use App\Entity\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$loader = new FilesystemLoader(__DIR__ . '/templates');  
$twig = new Environment($loader);
$users = [
    new User(1,"John Doe", "johnDoe@ya.ru","pswd1111"),
    new User(2,"David Brown", "davidik@ya.ru","pswd1234"),
    new User(3,"Wanda Maximoff", "WandaSc@ya.ru","neverland"),
    new User(4,"John Smith", "jsmithy@ya.ru","hello33"), 
    new User(5,"Sharon Davis", "itsharon@ya.ru","pswd1111") 
];

$comments = [
    new Comment($users[0], "I appreciate the support teams help."),
    new Comment($users[1], "I had some issues with the service"),
    new Comment($users[2], "Overall, Im satisfied."),
    new Comment($users[3],"They answered my questions and provided useful information."),
    new Comment($users[4], "This website is easy to navigate")
];
//объект класса DateTime, который мы задаем самостоятельно
$selectedDate = new \DateTime("2024-11-24 00:43:00",new \DateTimeZone('Europe/Moscow'));

$selectedComments = [];

foreach ($comments as $comment) {
    $userCreation = $comment->getCurrentUser()->getCreatedDate();
    if ($userCreation > $selectedDate) {
        $selectedComments[] = [
            'message' => $comment->getMessage(),
            'author' => $comment->getCurrentUser()->getName(),
            'created' => $userCreation->format('Y-m-d H:i:s')
        ];
    }
}
echo $twig->render('comments.twig', ['comments' => $selectedComments]);