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