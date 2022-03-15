//elements


function toggleinput() {
    let pswinput = document.getElementById('psw')
    let eye = document.getElementById('eye')

    // console.log(eye)

    let slashedeye = 'fa-eye-slash'
    let normaleye = 'fa-eye'

    if (eye.classList.contains(slashedeye)) {
        pswinput.type = 'text'
            // console.log(eye.classList.toString())
        eye.classList.replace(slashedeye, normaleye)
            // eye.className = eye.classList.toString()

        // console.log(eye)


    } else {
        pswinput.type = 'password'
            // console.log(eye.classList.toString())
        eye.classList.replace(normaleye, slashedeye)
            // eye.className = eye.classList.toString()
    }
}