const descriptionElement = document.getElementById('description');
        const text = descriptionElement.innerText;

        if (text.length > 50) {
            const truncatedText = text.slice(0, 50) + '...';
            descriptionElement.innerText = truncatedText;
        }
