<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="css/app.css">
        <script src="js/app.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="content">
            <h1>Card Game</h1>
            <button id="start">Start Game</button>
            <div id="game" class="game">
                <h3>Wins: <span id="wins">0</span></h3><h3>Loses: <span id="loses">0</span></h3>
                <h2>Current Card</h2>
                <p id="message"></p>
                <img id="card-img" src="/img/red_joker.png">
                <input type="hidden" id="suit" name="suit" value="" />
                <input type="hidden" id="val" name="value" value="" />
                <input type="hidden" id="cards" name="cards" value="" />
                <button id="lower">Lower</button>
                <button id="higher">Higher</button>
                <h3>Score: <span id="score">0</span></h3>
                <div class="winner" id="winner">
                </div>
            </div>
        </div>
    </body>
</html>