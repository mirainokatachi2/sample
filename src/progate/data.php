<?php
// menu.phpの読み込みを削除してください
require_once('menu.php');
// drink.phpとfood.phpを読み込んでください


// $juiceをDrinkクラスのインスタンスとしてください
$juice = new Menu('JUICE', 600, 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/juice.png');
// $coffeeをDrinkクラスのインスタンスとしてください
$coffee = new Menu('COFFEE', 500, 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/coffee.png');
// $curryをFoodクラスのインスタンスとしてください
$curry = new Menu('CURRY', 900, 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/curry.png');
// $pastaをFoodクラスのインスタンスとしてください
$pasta = new Menu('PASTA', 1200, 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/pasta.png');

$menus = array($juice, $coffee, $curry, $pasta);

?>