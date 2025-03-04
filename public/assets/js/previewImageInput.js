let cropper;

    function previewImageProfilePic(event, imgId, modalId, cropperImageId) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const modal = document.getElementById(modalId);
                const cropperImage = document.getElementById(cropperImageId);

                cropperImage.src = e.target.result;
                modal.classList.remove('hidden');

                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(file);
        }

            document.getElementById('cancelCropButton').addEventListener('click', function () {
                const modal = document.getElementById(modalId);
                modal.classList.add('hidden');

                document.getElementById('profileImageInput').value = '';
            });

            document.getElementById('cropImageButton').addEventListener('click', function () {
                if (cropper) {
                    const croppedCanvas = cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                    });

                    croppedCanvas.toBlob(function (blob) {
                        const croppedFile = new File([blob], 'cropped_' + document.getElementById('profileImageInput').files[0].name, {
                            type: 'image/jpeg',
                        });

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(croppedFile);
                        document.getElementById('profileImageInput').files = dataTransfer.files;

                        const imgElement = document.getElementById('profileImage');
                        imgElement.src = croppedCanvas.toDataURL();

                        const modal = document.getElementById(modalId);
                        modal.classList.add('hidden');
                    }, 'image/jpeg', 0.75);
                }
            });
    }
