console.log("WORK");
const bgImage = document.querySelector(".bg-image");
console.log(bgImage);

setInterval(() => {
    fetch("https://api.unsplash.com/photos/random/?client_id=UR3l5ThucatZkTCoUPxoDM7mvmBW1zUneBD6iRdOrx4")
        .then(response => response.json())
        .then((data) => {
            console.log(data.urls.raw);
            bgImage.style.backgroundImage = `url('${data.urls.raw}')`;
        });
},50000);