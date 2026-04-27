// Countdown Timer Logic
// Set a fixed target date so it doesn't reset on refresh
const launchDate = new Date('May 2, 2026 00:00:00').getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const distance = launchDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').innerText = days.toString().padStart(2, '0');
    document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
    document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');

    if (distance < 0) {
        clearInterval(countdownInterval);
        document.querySelector('.countdown-container').innerHTML = "<h3>We have launched!</h3>";
    }
}

const countdownInterval = setInterval(updateCountdown, 1000);
updateCountdown();

// Newsletter Form Logic
const subscribeForm = document.getElementById('subscribe-form');
const formMessage = document.getElementById('form-message');

subscribeForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const emailInput = document.getElementById('email');
    const email = emailInput.value;

    // Simulate API call
    formMessage.innerText = "Processing...";
    formMessage.style.color = "var(--text-muted)";

    setTimeout(() => {
        formMessage.innerText = "Thank you! We'll notify you soon.";
        formMessage.style.color = "var(--accent-glow)";
        emailInput.value = '';
    }, 1500);
});

// Interactive background effect (Optional)
document.addEventListener('mousemove', (e) => {
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;
    
    document.querySelector('.orb-1').style.transform = `translate(${x * 50}px, ${y * 50}px)`;
    document.querySelector('.orb-2').style.transform = `translate(${x * -50}px, ${y * -50}px)`;
});
