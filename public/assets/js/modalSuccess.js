document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('success-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModalBtn = document.getElementById('close-modal-btn');

    if (modal) {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');

        closeModalBtn.addEventListener('click', () => {
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });
    }
});
