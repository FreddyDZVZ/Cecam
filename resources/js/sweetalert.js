import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

window.Swal = Swal

window.addEventListener('swal', (event) => {
    const detail = event.detail || {}

    Swal.fire({
        title: detail.title ?? 'Listo',
        text: detail.text ?? '',
        icon: detail.icon ?? 'success',
        toast: detail.toast ?? false,
        position: detail.position ?? 'center',
        showConfirmButton: detail.showConfirmButton ?? true,
        timer: detail.timer ?? undefined,
        timerProgressBar: detail.timerProgressBar ?? false,
        confirmButtonText: detail.confirmButtonText ?? 'Aceptar',
        customClass: {
            popup: 'rounded-3xl',
            confirmButton: 'swal2-confirm btn-cecam',
        },
    })
})
