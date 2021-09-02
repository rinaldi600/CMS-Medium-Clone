const profilePicture = document.querySelector(".upload-file");
const previewPicture = document.querySelector(".preview-image");
const bgImage = document.querySelector(".bg-image");
const coverImage = [];

profilePicture.addEventListener("change",function (event) {
    try {
        previewPicture.src = URL.createObjectURL(profilePicture.files[0]);
        coverImage.push(profilePicture.files[0]);
        console.log(profilePicture.files);
    } catch (e) {
        console.log('BUTTON CANCEL')
    }

    if (profilePicture.files[0] === undefined) {
        previewPicture.src = "/picture-profile/thumbnail.jpg";
    }
});

setInterval(() => {
    fetch("https://api.unsplash.com/photos/random/?client_id=UR3l5ThucatZkTCoUPxoDM7mvmBW1zUneBD6iRdOrx4")
        .then(response => response.json())
        .then((data) => {
            console.log(data.urls.raw);
            bgImage.style.backgroundImage = `url('${data.urls.raw}')`;
        });
},50000);