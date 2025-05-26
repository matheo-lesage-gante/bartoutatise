<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Jeu de l'Anneau Gaulois Multi-joueurs</title>
<style>
  body {
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background: #e0f2f1;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #3e2723;
    user-select: none;
  }

  h1 {
    margin-top: 20px;
    text-shadow: 2px 2px #f7d200;
  }

  #setup {
    margin-top: 20px;
    margin-bottom: 10px;
  }

  #game-container {
    position: relative;
    width: 300px;
    height: 300px;
    margin: 20px 0;
  }

  #circle {
    width: 300px;
    height: 300px;
    border: 5px solid #5d4037;
    border-radius: 50%;
    position: relative;
    background: #fff8e1;
  }

  .zone {
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    pointer-events: none;
    opacity: 0.4;
  }

  #ring {
    position: absolute;
    width: 40px;
    height: 40px;
    border: 6px solid #d84315;
    border-radius: 50%;
    top: 130px;
    left: 130px;
    box-shadow: 0 0 10px #ff5722;
    background: #ffccbc;
    transform-origin: 50% 50%;
  }

  #players-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin: 15px 0;
  }

  .player {
    flex: 1 1 120px;
    min-width: 120px;
    margin: 5px;
    padding: 10px 20px;
    font-size: 1.2em;
    border-radius: 15px;
    border: none;
    cursor: pointer;
    user-select: none;
    box-shadow: 0 4px #a75b22;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #fff;
  }

  .player:active {
    box-shadow: none;
    transform: translateY(4px);
  }

  .score {
    font-weight: bold;
    margin-top: 8px;
    font-size: 1.3em;
  }

  #timer {
    font-size: 1.8em;
    margin-top: 10px;
    color: #d84315;
    text-shadow: 1px 1px #6d4c41;
  }

  #result {
    margin-top: 30px;
    font-size: 2em;
    font-weight: bold;
    color: #3e2723;
    text-shadow: 1px 1px 2px #f7d200;
    cursor: pointer;
  }
</style>
</head>
<body>

<h1>Jeu de l'Anneau Gaulois Multi-joueurs</h1>

<div id="setup">
  <label for="playerCount">Nombre de joueurs (1 à 4) : </label>
  <input type="number" id="playerCount" min="1" max="4" value="2" />
  <button id="startBtn">Démarrer le jeu</button>
</div>

<div id="game-container" style="display:none;">
  <div id="circle"></div>
  <div id="ring"></div>
</div>

<div id="players-container"></div>

<div id="timer" style="display:none;">Temps restant : 30 s</div>

<div id="result" style="display:none;" title="Clique ici pour rejouer"></div>

<script>
  const colors = ['#f7d200', '#a52a2a', '#388e3c', '#1976d2'];
  const playerNames = ['Astérix', 'Obélix', 'Panoramix', 'Assurancetourix'];

  const circle = document.getElementById('circle');
  const ring = document.getElementById('ring');
  const playersContainer = document.getElementById('players-container');
  const timerEl = document.getElementById('timer');
  const resultEl = document.getElementById('result');
  const startBtn = document.getElementById('startBtn');
  const playerCountInput = document.getElementById('playerCount');
  const gameContainer = document.getElementById('game-container');

  let playerCount = 2;
  let scores = [];
  let gameRunning = false;
  let angle = 0;
  let animationId;
  let timerInterval;
  let timeLeft = 30;
  let zones = [];

  // Crée les zones dans le cercle en quart de cercle (90° par joueur)
  function createZones(count) {
  zones = [];
  circle.innerHTML = '';
  const zoneSize = 150;

  for(let i=0; i<count; i++) {
    const zone = document.createElement('div');
    zone.classList.add('zone');
    zone.style.width = zoneSize + 'px';
    zone.style.height = zoneSize + 'px';

    switch(i) {
      case 0: // haut gauche
        zone.style.top = '20px';
        zone.style.left = '20px';
        zone.style.backgroundColor = colors[i];
        break;
      case 1: // bas droite
        zone.style.bottom = '20px';
        zone.style.right = '20px';
        zone.style.backgroundColor = colors[i];
        break;
      case 2: // bas gauche
        zone.style.bottom = '20px';
        zone.style.left = '20px';
        zone.style.backgroundColor = colors[i];
        break;
      case 3: // haut droite
        zone.style.top = '20px';
        zone.style.right = '20px';
        zone.style.backgroundColor = colors[i];
        break;
    }

    circle.appendChild(zone);
  }

  // Après avoir ajouté les zones au DOM, on calcule leurs centres relatifs à #circle
  const circleRect = circle.getBoundingClientRect();

  for(let i=0; i<count; i++) {
    const zoneEl = circle.children[i];
    const rect = zoneEl.getBoundingClientRect();

    zones.push({
      el: zoneEl,
      xOffset: rect.left - circleRect.left + rect.width / 2,
      yOffset: rect.top - circleRect.top + rect.height / 2,
      radius: zoneSize / 2,
      color: colors[i]
    });
  }
}

  // Crée les boutons joueurs et scores
  function createPlayersUI(count) {
    playersContainer.innerHTML = '';
    scores = new Array(count).fill(0);

    for(let i=0; i<count; i++) {
      const btn = document.createElement('button');
      btn.classList.add('player');
      btn.style.backgroundColor = colors[i];
      btn.id = 'btn' + i;
      btn.innerHTML = `${playerNames[i]} Attrape !<div class="score" id="score${i}">0</div>`;
      playersContainer.appendChild(btn);

      btn.addEventListener('click', () => {
        if (!gameRunning) return;

        // Position anneau (relatif au circle container)
        const ringX = parseFloat(ring.style.left) + ring.offsetWidth / 2;
        const ringY = parseFloat(ring.style.top) + ring.offsetHeight / 2;

        if (isInZone(ringX, ringY, zones[i])) {
          scores[i]++;
          document.getElementById('score' + i).textContent = scores[i];
        }
      });
    }
  }

  // Vérifie si l’anneau est dans la zone du joueur i
  function isInZone(x, y, zone) {
    const dx = x - zone.xOffset;
    const dy = y - zone.yOffset;
    const dist = Math.sqrt(dx*dx + dy*dy);
    return dist <= zone.radius;
  }

  // Mets à jour la position de l’anneau sur le cercle
  function updateRingPosition() {
    const centerX = 150;
    const centerY = 150;
    const orbitRadius = 100;

    const rad = angle * (Math.PI / 180);

    const x = centerX + orbitRadius * Math.cos(rad) - ring.offsetWidth / 2;
    const y = centerY + orbitRadius * Math.sin(rad) - ring.offsetHeight / 2;

    ring.style.left = x + 'px';
    ring.style.top = y + 'px';
  }

  // Boucle de rotation de l’anneau
  function gameLoop() {
    if (!gameRunning) return;
    angle += 3;
    if (angle >= 360) angle -= 360;
    updateRingPosition();
    animationId = requestAnimationFrame(gameLoop);
  }

  // Démarre le jeu
  function startGame() {
    playerCount = parseInt(playerCountInput.value);
    if (playerCount < 1 || playerCount > 4) {
      alert("Veuillez choisir un nombre de joueurs entre 1 et 4.");
      return;
    }

    scores = new Array(playerCount).fill(0);
    angle = 0;
    timeLeft = 30;
    gameRunning = true;

    createZones(playerCount);
    createPlayersUI(playerCount);

    gameContainer.style.display = 'block';
    timerEl.style.display = 'block';
    resultEl.style.display = 'none';

    for(let i=0; i<playerCount; i++) {
      document.getElementById('btn'+i).disabled = false;
      document.getElementById('score'+i).textContent = '0';
    }

    timerEl.textContent = `Temps restant : ${timeLeft} s`;

    animationId = requestAnimationFrame(gameLoop);

    timerInterval = setInterval(() => {
      timeLeft--;
      if (timeLeft < 0) timeLeft = 0;
      timerEl.textContent = `Temps restant : ${timeLeft} s`;
      if (timeLeft <= 0) {
        endGame();
      }
    }, 1000);
  }

  // Fin du jeu et affichage résultat
  function endGame() {
    gameRunning = false;
    cancelAnimationFrame(animationId);
    clearInterval(timerInterval);

    for(let i=0; i<playerCount; i++) {
      document.getElementById('btn'+i).disabled = true;
    }

    const maxScore = Math.max(...scores);
    const winners = [];
    scores.forEach((score, i) => {
      if(score === maxScore) winners.push(playerNames[i]);
    });

    if (maxScore === 0) {
      resultEl.textContent = "Personne n'a attrapé l'anneau...";
    } else if (winners.length === 1) {
      resultEl.textContent = `🏆 ${winners[0]} gagne avec ${maxScore} points !`;
    } else {
      resultEl.textContent = `🤝 Égalité entre ${winners.join(' et ')} avec ${maxScore} points !`;
    }

    resultEl.style.display = 'block';
  }

  resultEl.addEventListener('click', () => {
    startGame();
  });

  startBtn.addEventListener('click', () => {
    startGame();
  });

</script>

</body>
</html>
