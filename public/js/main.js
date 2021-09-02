console.log("WORKED");

const detailId = document.querySelectorAll(".detail-id");
const modalBody = document.querySelector(".modal-body");
console.log(modalBody);
for (const x of detailId) {
    x.addEventListener("click", function(event) {
        $.ajax({
            url:'http://localhost:8080/main/detail',
            type : "POST",
            dataType : "json",
            data : {"id" : event.target.dataset.value},
            success : function(data) {
                let componentCard;
                for (const x of data) {
                    componentCard = ` <div class="card" style="width: 18rem;">
                                            <img src="/picture-profile/${x.picture}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">${x.username}</h5>
                                                <p class="card-text">${x.email}</p>
                                            </div>
                                      </div>`;
                }
                modalBody.innerHTML = componentCard;
            },
            error : function(data) {
                // do something
            }
        });
    })
}