const gameBoard = document.getElementById('game-board');
const message = document.getElementById('message');
const restartButton = document.getElementById('restart');
let cards = ['A', 'A', 'B', 'B', 'C', 'C'];
let flippedCards = [];
let score = 0;
let attempts = 0;

function shuffleCards() {
    for (let i = cards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[j]] = [cards[j], cards[i]];
    }
}

function createBoard() {
    shuffleCards();
    gameBoard.innerHTML = '';
    cards.forEach((card, index) => {
        const cardElement = document.createElement('div');
        cardElement.classList.add('card', 'col-4', 'mb-3');
        cardElement.dataset.card = card;
        cardElement.dataset.index = index;
        cardElement.addEventListener('click', flipCard);
        gameBoard.appendChild(cardElement);
    });
}

function flipCard() {
    if (flippedCards.length < 2 && !this.classList.contains('flipped')) {
        this.classList.add('flipped');
        this.textContent = this.dataset.card;
        flippedCards.push(this);

        if (flippedCards.length === 2) {
            setTimeout(checkMatch, 1000);
        }
    }
}

function checkMatch() {
    const [card1, card2] = flippedCards;
    if (card1.dataset.card === card2.dataset.card) {
        score++;
        message.textContent = `Match found ! Score : ${score}`;
        if (score === 3) {
            endGame(true);
        }
    } else {
        attempts++;
        card1.classList.remove('flipped');
        card2.classList.remove('flipped');
        card1.textContent = '';
        card2.textContent = '';
        message.textContent = `No correspondance. Remaining attempt : ${3 - attempts}`;
        if (attempts === 3) {
            endGame(false);
        }
    }
    flippedCards = [];
}

function endGame(isWin) {
    gameBoard.innerHTML = '';
    if (isWin) {
        message.textContent = 'Congratulations ! You Won !';
    } else {
        message.textContent = 'Game over. You have lost.';
    }
    saveScore();
}

function saveScore() {
    fetch('php/game_logic.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `score=${score}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Score Saved ');
        }
    });
}

restartButton.addEventListener('click', () => {
    score = 0;
    attempts = 0;
    message.textContent = '';
    createBoard();
});

createBoard();