const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");

mobileMenuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
});

function updateClock() {
    const now = new Date();
    const timeElement = document.getElementById("currentTime");
    const dateElement = document.getElementById("currentDate");
    const hourHand = document.getElementById("hourHand");
    const minuteHand = document.getElementById("minuteHand");
    const secondHand = document.getElementById("secondHand");

    timeElement.textContent = now.toLocaleTimeString("en-US", {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    });
    dateElement.textContent = now.toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    const hours = now.getHours() % 12;
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();

    const hourAngle = (hours + minutes / 60) * 30;
    const minuteAngle = (minutes + seconds / 60) * 6;
    const secondAngle = seconds * 6;

    hourHand.style.transform = `rotate(${hourAngle}deg)`;
    minuteHand.style.transform = `rotate(${minuteAngle}deg)`;
    secondHand.style.transform = `rotate(${secondAngle}deg)`;
}

updateClock();
setInterval(updateClock, 1000);
