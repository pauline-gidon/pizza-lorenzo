let productContainer,buttons;
function reRender(products)
{
    productContainer.innerHTML = '';
    products.forEach(product => {
        let str = JSON.stringify(product);
        let productElement = document.createElement('div');
        productElement.classList.add('card','card-list-product');

        productElement.innerHTML = `
            
            <div class="card-body">
                <h5 class="card-title"><a href="product/show/${product.id}">${product.name}</a></h5>
                <img src="uploads/pictures/products/${product.pictures}" class="full-img"/>
                <p class="card-text">${product.description}</p>
                <p>${product.price} €</p>
                <p class="btn btn-primary add-order" data-product-name="${product.name}" data-product-price="${product.price}">Ajouter à ma commande</p>
            </div>
        `;
        productContainer.append(productElement);
        let btns = document.querySelectorAll('.add-order')
        for(let i = 0; i < btns.length; i++ ){
            btns[i].addEventListener('click', addMyOrder)
        }
    })
}

async function fetchProductsByCategory()
{
    let url = 'product/by-category/'+this.dataset.category;
     await fetch(url, {method : 'GET'})
        .then(response => response.json())
        .then(result => reRender(result)).catch(error => console.log(error));
}

function addMyOrder(){

    let productOrder = {
        "name": this.dataset.productName,
        "price": this.dataset.productPrice,
    }
    addProductBasket(productOrder);
}
function saveBasket(basket){
    localStorage.setItem("basket", JSON.stringify(basket))
}

function getBasket(){
    let basket= localStorage.getItem("basket");
    if(null == basket){
        return [];
    }else {
        return JSON.parse(basket);
    }
}

function addProductBasket(product){
    let basket = getBasket();
    let foundProduct = basket.find(p => p.name == product.name);
    console.log(foundProduct);
    if(foundProduct != undefined)
    {
        foundProduct.quantity++;
    }else{
        product.quantity = 1;
        basket.push(product);
    }
    saveBasket(basket);
}
function removeProductBasket(product){
    let basket = getBasket();
    basket = basket.filter(p => p.name != product.name);
    saveBasket(basket);
}
function changeQuantity(product, quantity){
    let basket = getBasket();
    let foundProduct = basket.find(p => p.name == product.name);
    if(foundProduct != undefined)
    {
        foundProduct.quantity += quantity;
        if(foundProduct.quantity <= 0 ){
            removeProductBasket(foundProduct);
        }else{
            saveBasket(basket);
        }
    }
}

document.addEventListener('DOMContentLoaded', function(){
    productContainer = document.querySelector('#list-products');
    buttons = document.querySelectorAll('.fetch-category');
   for(let i = 0; i < buttons.length; i++){
       buttons[i].addEventListener('click', fetchProductsByCategory );
   }
});

