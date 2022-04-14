let res = document.getElementsByClassName('result')[0];

var ordine = "";
var generi = "";

function send_request() {
    let xhtpp = new XMLHttpRequest()

    xhtpp.open('GET', `../components/filter.php?generi=${generi}&ordine=${ordine}`)
    xhtpp.onreadystatechange = function() {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (this.readyState === XMLHttpRequest.DONE) {

            if (this.status === 0 || (this.status >= 200 && this.status < 400)) {
                // The request has been completed successfully
                let response = this.responseText;
                console.log(response)
                res.innerHTML = response;
            } else {
                //errore
            }
        }
    }
    xhtpp.send()
}

function update_ordine(children) {
    for (let element of children) {
        if (element.checked) {
            ordine = element.value;
            break;
        }
    }

    send_request();
}

function update_generi(children) {
    generi = [];
    for (let element of children) {
        if (element.classList[0] === 'checkbox-genere') {
            if (element.checked) {
                generi.push(element.value)
            }
        }
    }
    console.log(generi)
    generi = encodeURIComponent(JSON.stringify(generi))

    send_request()

}