/**
    * To be used in Livewire
    *
    * **/
// Sweetalert
const SwalModal = (icon, title, html, redirectUrl) => {
    Swal.fire({
        icon,
        title,
        html
    }).then(function () {
        if (redirectUrl) {
            window.location = redirectUrl;
        }
    })
}

const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
    Swal.fire({
        icon,
        title,
        html,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText,
        cancelButtonText: 'Close',
        reverseButtons: true,
    }).then(result => {
        if (result.value) {
            return livewire.emit(method, params)
        }

        if (callback) {
            return livewire.emit(callback)
        }
    })
}

const SwalAlert = (icon, title, timeout = 7000) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: timeout,
        onOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon,
        title
    })
}

// Listener
document.addEventListener('DOMContentLoaded', () => {
    this.livewire.on('swal:modal', data => {
        SwalModal(data.icon, data.title, data.text, data.redirectUrl)
    })

    this.livewire.on('swal:confirm', data => {
        SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
    })

    this.livewire.on('swal:alert', data => {
        SwalAlert(data.icon, data.title, data.timeout)
    })

    this.livewire.on('swal:dropdown', data => {
        SwalDropdown(data.icon, data.title, data.inputOptions, data.method, data.params)
    })

})
