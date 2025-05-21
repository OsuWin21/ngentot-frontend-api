const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const cropPreview = document.getElementById('cropPreview');

const bgInput = document.getElementById('bgInput');
const bgPreview = document.getElementById('bgPreview');
const bgCropPreview = document.getElementById('bgCropPreview');

const cropButton = document.getElementById('submitButton');
let avatarCropper;
let bgCropper;

imageInput.addEventListener('change', (e) => {
    handleImageUpload(e, {
        previewElement: imagePreview,
        cropPreviewElement: cropPreview,
        aspectRatio: 1,
        cropWidth: 250,
        cropHeight: 250,
        cropperInstance: 'avatar'
    });
});

bgInput.addEventListener('change', (e) => {
    handleImageUpload(e, {
        previewElement: bgPreview,
        cropPreviewElement: bgCropPreview,
        aspectRatio: 20 / 5,
        cropWidth: 1200,
        cropHeight: 300,
        cropperInstance: 'background'
    });
});

function handleImageUpload(e, options) {
    const file = e.target.files[0];
    if (!file) return;

    if (!['image/png', 'image/jpeg'].includes(file.type)) {
        alert('Hanya format PNG dan JPG yang diperbolehkan!');
        e.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = (event) => {
        options.previewElement.src = event.target.result;

        if (options.cropperInstance === 'avatar' && avatarCropper) {
            avatarCropper.destroy();
        }
        if (options.cropperInstance === 'background' && bgCropper) {
            bgCropper.destroy();
        }

        const newCropper = new Cropper(options.previewElement, {
            aspectRatio: options.aspectRatio,
            viewMode: 1,
            autoCropArea: 0.8,
            crop: function (event) {
                const canvas = newCropper.getCroppedCanvas({
                    width: options.cropWidth,
                    height: options.cropHeight
                });
                options.cropPreviewElement.style.display = 'block';
                options.cropPreviewElement.src = canvas.toDataURL('image/jpeg');
            }
        });

        if (options.cropperInstance === 'avatar') {
            avatarCropper = newCropper;
        } else {
            bgCropper = newCropper;
        }
    };
    reader.readAsDataURL(file);
}

cropButton.addEventListener('click', async (e) => {
    e.preventDefault();

    const userId = window.location.pathname.split('/').pop();
    const aboutMeContent = document.getElementById('userpageContent').value;

    const formData = new FormData();
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    formData.append('user_id', userId);
    formData.append('userpage-content', aboutMeContent);

    // Helper untuk convert canvas ke Blob
    const canvasToBlob = (canvas, fileName) => {
        return new Promise((resolve) => {
            canvas.toBlob((blob) => {
                resolve({ blob, fileName });
            }, 'image/png', 0.9);
        });
    };

    const blobTasks = [];

    if (avatarCropper) {
        const avatarCanvas = avatarCropper.getCroppedCanvas({
            width: 300,
            height: 300
        });
        blobTasks.push(canvasToBlob(avatarCanvas, 'avatar'));
    }

    if (bgCropper) {
        const bgCanvas = bgCropper.getCroppedCanvas({
            width: 1200,
            height: 300
        });
        blobTasks.push(canvasToBlob(bgCanvas, 'background'));
    }

    const results = await Promise.all(blobTasks);
    results.forEach(({ blob, fileName }) => {
        formData.append(fileName, blob, `${userId}.png`);
    });

    if (formData.has('avatar') || formData.has('background') || aboutMeContent !== "{{ $user->userpage_content }}") {
        fetch(`/u/edit/process/${userId}`, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (data.avatar) {
                        document.querySelectorAll('.user-avatar').forEach(img => img.src = data.avatar + '?t=' + Date.now());
                    }
                    if (data.background) {
                        document.querySelectorAll('.user-background').forEach(img => img.src = data.background + '?t=' + Date.now());
                    }
                    alert('Update berhasil!');
                    window.location.href = window.location.pathname + '?t=' + new Date().getTime();
                } else {
                    throw new Error(data.error || 'Unknown error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(`Error: ${error.message}`);
            });
    } else {
        alert('No changes!');
    }

});