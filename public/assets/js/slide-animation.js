const tabs = [taskBoardTab, taskListTab, timeLineTab];
const grids = [taskBoardGrid, taskListGrid, timeLineGrid];
const content = { taskBoard, taskList, timeLine };

// Hitung tinggi setiap konten sekali saat DOM dimuat
const heights = {
    taskBoard: grids[0].scrollHeight,
    taskList: grids[1].scrollHeight,
    timeLine: grids[2].scrollHeight,
};

// Fungsi untuk mereset tinggi semua konten
function resetHeight() {
    Object.values(content).forEach((section) => {
        section.style.height = "0px";
    });
}

// Fungsi untuk mengatur tab aktif
function setActiveTab(activeTab) {
    tabs.forEach((tab) => {
        const underline = tab.querySelector("span:last-child");
        const text = tab.querySelector("span:first-child");
        underline.classList.toggle("scale-x-100", tab === activeTab);
        underline.classList.toggle("scale-x-0", tab !== activeTab);
        text.classList.toggle("text-blue-500", tab === activeTab);
        text.classList.toggle("text-gray-800", tab !== activeTab);
    });
}

// Event listener untuk taskListTab
taskListTab.addEventListener("click", () => {
    taskBoard.style.transform = "translateX(-100%)";
    timeLine.style.transform = "translateX(100%)";
    taskList.style.transform = "translateX(0%)";
    taskBoard.style.opacity = 0;
    timeLine.style.opacity = 0;
    taskList.style.opacity = 1;

    taskList.style.display = "block";
    taskBoard.style.display = "none";
    timeLine.style.display = "none";

    resetHeight();
    taskList.style.height = `${heights.taskList}px`;

    setActiveTab(taskListTab);
});

// Event listener untuk taskBoardTab
taskBoardTab.addEventListener("click", () => {
    taskBoard.style.transform = "translateX(0%)";
    taskList.style.transform = "translateX(100%)";
    timeLine.style.transform = "translateX(100%)";
    taskBoard.style.opacity = 1;
    taskList.style.opacity = 0;
    timeLine.style.opacity = 0;

    taskList.style.display = "none";
    taskBoard.style.display = "block";
    timeLine.style.display = "none";

    resetHeight();
    taskBoard.style.height = `${heights.taskBoard}px`;

    setActiveTab(taskBoardTab);
});

// Event listener untuk timeLineTab
timeLineTab.addEventListener("click", () => {
    taskBoard.style.transform = "translateX(-200%)";
    taskList.style.transform = "translateX(-100%)";
    timeLine.style.transform = "translateX(0%)";
    taskBoard.style.opacity = 0;
    taskList.style.opacity = 0;
    timeLine.style.opacity = 1;

    taskList.style.display = "none";
    taskBoard.style.display = "none";
    timeLine.style.display = "block";

    resetHeight();
    timeLine.style.height = `${heights.timeLine}px`;

    setActiveTab(timeLineTab);
});

// Atur tab aktif pertama kali saat DOM dimuat
document.addEventListener("DOMContentLoaded", () => {
    setActiveTab(taskBoardTab);
    taskBoard.style.height = `${heights.taskBoard}px`; // Set tinggi awal untuk taskBoard
});
