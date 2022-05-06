require('./bootstrap');
import axios from 'axios';
window.onload = function(){
    const gameArea = document.getElementById("game");
    const message = document.getElementById("message");
    const winner = document.getElementById("winner");

    const suit = document.getElementById("suit");
    const val = document.getElementById("val");
    const cards = document.getElementById("cards");
    const cardImg = document.getElementById("card-img");
    const wins = document.getElementById("wins");
    const loses = document.getElementById("loses");
    const score = document.getElementById("score");

    document.getElementById("start").onclick = function() {
        axios.post('/start-game')
        .then(function (response) {
            suit.value=response.data['suit'];
            val.value=response.data['val'];
            cards.value=response.data['all_cards'];
            cardImg.src='/img/' + response.data['current_card'] + '.png';
            gameArea.style.display = "block";
        })
    };
    document.getElementById("lower").onclick = function() {
        axios.post('/card', {
            params: {
                type: 'lower',
                wins: wins.textContent,
                loses: loses.textContent,
                score: score.textContent,
                cards: cards.value,
                suit: suit.value,
                val: val.value
            }
        })
        .then(function (response) {
            suit.value=response.data['suit'];
            val.value=response.data['val'];
            cards.value=response.data['all_cards'];
            cardImg.src='/img/' + response.data['current_card'] + '.png';
            wins.innerHTML = response.data['wins'];
            loses.innerHTML = response.data['loses'];
            score.innerHTML = response.data['score'];
            message.innerHTML = response.data['msg'];
            message.style.display = "block";

            if(response.data['won'] == true) {
                const winnerCards = response.data['all_cards'];
                var imgs = winnerCards.map(function(winnerCard) {
                    var img = new Image();
                    img.src = '/img/' + winnerCard + '.png';
                    winner.appendChild(img);
                    return img;
                });
            }
        })
    };
    document.getElementById("higher").onclick = function() {
        axios.post('/card', {
            params: {
                type: 'higher',
                wins: wins.textContent,
                loses: loses.textContent,
                score: score.textContent,
                cards: cards.value,
                suit: suit.value,
                val: val.value
            }
        })
        .then(function (response) {
            suit.value=response.data['suit'];
            val.value=response.data['val'];
            cards.value=response.data['all_cards'];
            cardImg.src='/img/' + response.data['current_card'] + '.png';
            wins.innerHTML = response.data['wins'];
            loses.innerHTML = response.data['loses'];
            score.innerHTML = response.data['score'];
            message.innerHTML = response.data['msg'];
            message.style.display = "block";
        })
    };
    
};