import Swal from "sweetalert2";

function msgShowOkDialog(title, message, iconType = 'success') {

    Swal.fire({
        title: title,
        text: message,
        icon: iconType,
        confirmButtonText: 'Okay',
        timer: 3000
    });
}

export { msgShowOkDialog };