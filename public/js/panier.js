document.addEventListener('DOMContentLoaded', function(){

let paniercontainner = document.querySelector('#containner-panier');
let total;
let basket = localStorage.getItem("basket");
if(basket != undefined)
{

    basket = JSON.parse(basket);
    basket.forEach(product => {
        let productpanier = document.createElement('tr');
        productpanier.innerHTML = `
            <th data-product-order="${product.id}" scope="row">${product.name}</th>
            <td>${product.quantity}</td>
            <td>${product.price} €</td>
            <td data-subtotal="${parseFloat(product.quantity)*parseFloat(product.price)}">${parseFloat(product.quantity)*parseFloat(product.price)} €</td>
        `;

        paniercontainner.append(productpanier);
        });

    let baskethtml = document.querySelector('.basket');

    subtotals = document.querySelectorAll('[data-subtotal]');
    for( let i = 0; i < subtotals.length; i++ ){
        if( i == 0 ){
            total = 0
        }
        let sub =  parseFloat(subtotals[i].dataset.subtotal);
        total += sub;
    }

    let totalcontainner = document.createElement('tr');

    totalcontainner.innerHTML = `
            <th scope="row">TOTAL : ${total} €</th>
        `;

    baskethtml.append(totalcontainner);
    let btnValidate = document.createElement('button');
    btnValidate.classList.add("btn", "btn-primary", "add-order");
    btnValidate.innerHTML = "Acheter";
    btnValidate.addEventListener('click', function(){
        let formData = new FormData();
        formData.append("order", localStorage.getItem("basket"));

        fetch("order/new",
            {
                body: formData,
                method: "post"
            }).then(response => response.json())
            .then(result => {
                window.location.href = '/order/payement/' + result.id
            } );
    });

    baskethtml.append(btnValidate);




}else{
    paniercontainner.innerHTML = 'Aucun produit dans votre panier';
}

});
