function previewImageProfilePic(event, imgId) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const imgElement = document.getElementById(imgId);
        imgElement.src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}