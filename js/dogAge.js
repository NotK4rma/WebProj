
const dogAgeArticle = document.querySelector('.calcDog button');
console.log(dogAgeArticle);
const body = document.body;


const modalHTML = `
<div id="dog-age-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Dog Age Calculator</h2>
        <p>Convert your dog's age to human years!</p>
        
        <div class="calculator-form">
            <div class="input-group">
                <label for="dog-age">Your Dog's Age (in years):</label>
                <input type="number" id="dog-age" min="0" max="30" step="0.5" placeholder="Enter age">
            </div>
            
            <button id="calculate-btn">Calculate</button>
            
            <div class="result-container">
                <div id="result-display">
                    <span class="dog-emoji">🐶</span> = <span class="human-emoji">👤</span>
                    <div id="result-text">Enter your dog's age to see equivalent human years</div>
                </div>
                <p id="calculation-method" class="calculation-note">Based on modern research that shows dog aging isn't a simple 7:1 ratio.</p>
            </div>
        </div>
    </div>
</div>
`;


body.insertAdjacentHTML('beforeend', modalHTML);


const modal = document.getElementById('dog-age-modal');
const closeBtn = document.querySelector('.close-btn');
const calculateBtn = document.getElementById('calculate-btn');
const dogAgeInput = document.getElementById('dog-age');
const resultText = document.getElementById('result-text');


dogAgeArticle.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});
calculateBtn.addEventListener('click', calculateAge);
dogAgeInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        calculateAge();
    }
});


function openModal() {
    modal.style.display = 'flex';
    body.classList.add('modal-open');
    dogAgeInput.focus();
}

function closeModal() {
    modal.style.display = 'none';
    body.classList.remove('modal-open');
   
    dogAgeInput.value = '';
    resultText.textContent = 'Enter your dog\'s age to see equivalent human years';
}

function calculateAge() {
    const dogAge = parseFloat(dogAgeInput.value);
    
    if (isNaN(dogAge) || dogAge < 0) {
        resultText.textContent = 'Please enter a valid age';
        return;
    }
    
    // Modern calculation based on research
    // First year = 15 human years
    // Second year = additional 9 years (24 total)
    // Each year after = ~4-5 years
    
    let humanAge;
    if (dogAge <= 1) {
        humanAge = dogAge * 15;
    } else if (dogAge <= 2) {
        humanAge = 15 + (dogAge - 1) * 9;
    } else {
        humanAge = 24 + (dogAge - 2) * 4.5;
    }
    
    
    humanAge = Math.round(humanAge * 10) / 10;
    
    resultText.innerHTML = `<strong>${dogAge} dog ${dogAge === 1 ? 'year' : 'years'} = ${humanAge} human ${humanAge === 1 ? 'year' : 'years'}</strong>`;
    
   
    resultText.classList.add('pulse');
    setTimeout(() => {
        resultText.classList.remove('pulse');
    }, 1000);
}


if (typeof module !== 'undefined') {
    module.exports = { calculateAge };
}