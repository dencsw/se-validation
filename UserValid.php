<?php
namespace App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Validator\Validation;
use App\Entity\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader(__DIR__ . '/templates');  
$twig = new Environment($loader);
$users = [
    new User(1,"John Doe", "johnDoe@ya.ru","pswd1111"),
    new User(2,"Ja", "janeDoe@ya.ru","pswd1234"),
    new User(3,"Wanda Maximoff", "WandaSc@ya.ru","neverland"),
    new User(-10,"Natasha Romanoff", "nataly@ya.ru","hello"), 
    new User(5,"King Solomon", "kingSolomon","pswd1111") 
];


$validator = Validation::createValidatorBuilder()
->enableAttributeMapping()
->getValidator();

$usersErrors = [];
foreach($users as $user) {
    $violations = $validator->validate($user);
    if (count($violations) > 0) {
        $curUserErrors = "";
        foreach($violations as $violation) {
            $curUserErrors = $curUserErrors . $violation->getMessage()."\n";
        }
        $usersErrors[] = [
            'userData'=>$user->getData(),
            'errors'=>$curUserErrors
        ];
    }
}

echo $twig->render('users.twig', ['users' => $usersErrors]);