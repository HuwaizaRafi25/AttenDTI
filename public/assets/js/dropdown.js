const todoDropdown = document.getElementById("todoDropdown");
const todoTasks = document.getElementById("todoTasks");
const inprogressDropdown = document.getElementById("inprogressDropdown");
const inprogressTasks = document.getElementById("inprogressTasks");
const inreviewDropdown = document.getElementById("inreviewDropdown");
const inreviewTasks = document.getElementById("inreviewTasks");
const completedDropdown = document.getElementById("completedDropdown");
const completedTasks = document.getElementById("completedTasks");
const backlogDropdown = document.getElementById("backlogDropdown");
const backlogTasks = document.getElementById("backlogTasks");

todoDropdown.addEventListener("click", () => {
    todoTasks.classList.toggle("hidden");
    const icon = todoDropdown.querySelector("i");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-right");
});
inprogressDropdown.addEventListener("click", () => {
    inprogressTasks.classList.toggle("hidden");
    const icon = inprogressDropdown.querySelector("i");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-right");
});
inreviewDropdown.addEventListener("click", () => {
    inreviewTasks.classList.toggle("hidden");
    const icon = inreviewDropdown.querySelector("i");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-right");
});
completedDropdown.addEventListener("click", () => {
    completedTasks.classList.toggle("hidden");
    const icon = completedDropdown.querySelector("i");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-right");
});
backlogDropdown.addEventListener("click", () => {
    backlogTasks.classList.toggle("hidden");
    const icon = backlogDropdown.querySelector("i");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-right");
});
