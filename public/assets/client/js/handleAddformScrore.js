function handleFormCaseScore() {
    const addBtn = document.getElementById("addFormBtn");
    let closeBtn = document.querySelectorAll(".closeFormBtn");
    const noteParent = document.getElementById("form-block");
    showBtnForm();
    addBtn.onclick = function (e) {
        const noteChild = document.createElement("div");
        noteChild.classList.add("form-flex");
        noteChild.innerHTML = `
            <div class='form-flex-group flex-3'>
                <div class="form-flex-tiltle">
                    <label >Tiêu đề: </label>
                </div>
                <div class="form-flex-input">
                    <input type="text" class="form-tbl-input" required name="titleCR[]" placeholder="Tiêu đề điểm...">
                </div>
                </div>
                <div class='form-flex-group flex-2'>
                <div class="form-flex-tiltle">
                    <label >Trọng số: </label>
                </div>
                <div class="form-flex-input">
                    <input name="percentCR[]" class="form-tbl-input" min="0" max="100" required type="number" placeholder="Trọng số (%)">
                </div>
            </div>

            <div class='form-flex-group form-icon-close  flex-1'>
                <i class="closeFormBtn"><ion-icon name="close-outline"></ion-icon></i>
            </div>
        `;
        noteParent.appendChild(noteChild);
        closeBtn = document.querySelectorAll(".closeFormBtn");
        for (let i = 0; i < closeBtn.length; i++) {
            closeBtn[i].onclick = function () {
                // console.log(this.parentElement.parentElement);
                noteParent.removeChild(this.parentElement.parentElement);
            };
        }
        showBtnForm();
    };

    // if (closeBtn) {

    // }

    // closeBtn.onclick = function (e) {
    //     console.log(e.pa);
    // };

    function showBtnForm() {
        const input = document.querySelectorAll(".form-tbl-input");

        const btnForm = document.getElementById("btn-form-ud");
        for (let j = 0; j < input.length; j++) {
            input[j].oninput = function () {
                btnForm.removeAttribute("disabled");
                btnForm.classList.remove("disabled-btn");
                console.log(123);
            };
            // console.log(input[j]);
        }
    }
}

handleFormCaseScore();
