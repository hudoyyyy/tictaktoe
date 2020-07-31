<link href="/public/styles/game.css" rel="stylesheet">
<script src="/public/scripts/game.js"></script>
<div class="main-page">
    <div class="gamer-block">
        Игра №: <p id="game-id"><?php /** @var string $game_id */
            echo $game_id; ?></p>
    </div>
    <div class="gamer-block">
        Игрок 1: <p id="first-gamer"><?php /** @var string $first_gamer */
           echo $first_gamer ?></p>
    </div>
    <div class="conteiner">
        <a class="row-el" id="1"></a>
        <a class="row-el" id="2"></a>
        <a class="row-el" id="3"></a>
        <a class="row-el" id="4"></a>
        <a class="row-el" id="5"></a>
        <a class="row-el" id="6"></a>
        <a class="row-el" id="7"></a>
        <a class="row-el" id="8"></a>
        <a class="row-el" id="9"></a>
    </div>
    <div class="gamer-block">
        Игрок 2: <p id="second-gamer"><?php /** @var string $second_gamer */
            echo $second_gamer; ?> </p>
    </div>
    <div class="gamer-block">
        Ход: <p id="turn"></p>
    </div>
</div>
<a href="/home"><button>Вернуться</button></a>
