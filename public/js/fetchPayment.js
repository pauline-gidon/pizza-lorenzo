async function fetchData(e){
    e.preventDefault();

    let paymentType =  document.querySelector('input[name="payment[type]"]:checked').value;
    let orderId = document.querySelector('#orderId').value;

   await fetch(paymentRoute, {
        method: 'POST',
        body: JSON.stringify({
            'paymentType': paymentType,
            'orderId': orderId,
        }),
        headers: {
            'Content-type': 'application/json'
        }
    }).then(response => response.json()).then(result => {
        console.log(result);
        if(result === "payment-valide"){
            localStorage.setItem("basket", JSON.stringify([]))
            window.location.href = "/";
        }
    }).catch( error => {
        console.log(error)});
}

document.addEventListener('DOMContentLoaded', function(){

  let form =  document.querySelector('#paymentForm');

  form.addEventListener('submit', fetchData);

});
