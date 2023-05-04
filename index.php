<?php

require 'vendor/autoload.php';

use App\User;
use App\Comment;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Validation;

// Task_1
echo 'Task_1<br/>';

$validator = Validation::createValidator();
$violations = [];

$users[] = new User(1, "Denis", "denis@yandex.ru", "Denis12345");
$users[] = new User(2, "Ivan", "ivan@gmail.com", "Ivan12345");
$users[] = new User(3, "Kirill", "kirill@gmail.com", "Kirill12345");
$users[] = new User(4, "Artem", "artem@gmail.com", "Artem12345");
$users[] = new User(5, "Pavel", "pavel@gmail.com", "Pavel12345");

foreach($users as $user) {
	echo 'ID - ' . $user->id . ' : Name - ' . $user->name . ' : Mail - ' . $user->email . ' : Password - ' . $user->password . ' : Created at ' . $user->getCreatedOn() . '<br/>';

	$violations[] = $validator->validate($user->id, [
		new Positive(),
	]);

	$violations[] = $validator->validate($user->name, [
		new NotBlank(),
		new NotNull(),
		new Length(['min' => 4, 'max' => 32])
	]);

	$violations[] = $validator->validate($user->password, [
		new NotBlank(),
		new NotNull(),
		new Length(['min' => 8, 'max' => 32])
	]);
}

if (0 !== count($violations)) {
    foreach ($violations as $items) {
		foreach($items as $violation) {
			echo $violation->getMessage() . '<br/>';
		}
    }
}

// Task_2
echo '<br/>';
echo 'Task_2<br/>';
$messages[] = "message 1";
$messages[] = "message 2";
$messages[] = "message 3";
$messages[] = "message 4";
$messages[] = "message 5";

$comments = [];
for($i = 0; $i < count($messages); $i++) {
	$comments[] = new Comment($users[$i], $messages[$i]);
}

$datetime = new DateTime('2020-09-12 12:12:12');
echo $datetime->format('Y-m-d H:i:s') . '<br/>';
foreach($comments as $comment) {
	if($comment->user->createdOn > $datetime) {
		echo $comment . '<br/>';
	}
}
