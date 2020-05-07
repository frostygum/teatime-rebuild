// !DROPDOWN
function toggleDropdown(targetId) {
    document.getElementById(targetId).classList.toggle("show-dropdown");
}

window.onclick = function(event) {
    if (!event.target.matches('button')) {
        let dropdown = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdown.length; i++) {
            let openDropdown = dropdown[i];
            if (openDropdown.classList.contains('show-dropdown')) {
                openDropdown.classList.remove('show-dropdown');
            }
        }
    }
}

// !ALERT
function toggleAlert(targetId) {
    let alertEvent = new CustomEvent('show-alert', {detail: targetId});
    document.getElementById(targetId).classList.toggle("show-alert");
    window.dispatchEvent(alertEvent);
}

window.addEventListener('show-alert', function(event) {
    let openAlert = document.getElementById(event.detail);
    if(openAlert.classList.contains('show-alert')) {
        setTimeout(function() {
            document.getElementById(event.detail).classList.remove("show-alert");
        }, 4000);
    }
});

// !MODAL
function toggleModal(targetId) {
    document.getElementById(targetId).classList.toggle('show-modal');
}

window.onclick = function(event) {
    if (!event.target.matches('button') && event.target.matches('.modal-wrapper')) {
        let modal = document.getElementsByClassName("modal");
        let i;
        for (i = 0; i < modal.length; i++) {
            let openModal = modal[i];
            if (openModal.classList.contains('show-modal')) {
                openModal.classList.remove('show-modal');
            }
        }
    }
}

// !CUSTOM SELECT 

let x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
    let selElement = x[i].getElementsByTagName("select")[0];

    let a = document.createElement("div");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElement.options[selElement.selectedIndex].innerHTML;
    x[i].appendChild(a);

    let b = document.createElement("div");
    b.setAttribute("class", "select-items select-hide");

    for (j = 0; j < selElement.length; j++) {

        let c = document.createElement("div");
        c.innerHTML = selElement.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            let y, i, k, s, h;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            h = this.parentNode.previousSibling;
            for (i = 0; i < s.length; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                for (k = 0; k < y.length; k++) {
                    y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}

function closeAllSelect(elmnt) {
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");

    for (i = 0; i < y.length; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < x.length; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}

document.addEventListener("click", closeAllSelect);