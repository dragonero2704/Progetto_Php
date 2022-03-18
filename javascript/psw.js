//elements
let pswinput = document.getElementById('psw')
let eye = document.getElementById('eye')

// console.log(eye)
eye.addEventListener('click', () => {
    if (eye.firstChild.nodeValue == 'Show') {
        pswinput.type = 'text'
            // console.log(eye.classList.toString())
        eye.firstChild.nodeValue = 'Hide'
            // eye.className = eye.classList.toString()

        // console.log(eye)


    } else {
        pswinput.type = 'password'
            // console.log(eye.classList.toString())
            eye.firstChild.nodeValue = 'Show'

            // eye.className = eye.classList.toString()
    }
})