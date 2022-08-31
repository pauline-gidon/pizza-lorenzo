let productContainer,buttons;
function reRender(products)
{
    productContainer.innerHTML = '';
    products.forEach(product => {
        let productElement = document.createElement('div');
        productElement.classList.add('card','card-list-product');
        productElement.innerHTML = `
            
            <div class="card-body">
                <h5 class="card-title"><a href="product/show/${product.id}">${product.name}</a></h5>
                <img src="uploads/pictures/products/${product.pictures}" class="full-img"/>
                <p class="card-text">${product.description}</p>
                <p>${product.price} €</p>
                <a href="#" class="btn btn-primary">Ajouter à ma commande</a>
            </div>
        `;
        productContainer.append(productElement);
    })
}

async function fetchProductsByCategory()
{
    let url = 'product/by-category/'+this.dataset.category;
     await fetch(url, {method : 'GET'})
        .then(response => response.json())
        .then(result => reRender(result)).catch(error => console.log(error));
}

document.addEventListener('DOMContentLoaded', function(){
    productContainer = document.querySelector('#list-products');
    buttons = document.querySelectorAll('.fetch-category');
   for(let i = 0; i < buttons.length; i++){
       buttons[i].addEventListener('click', fetchProductsByCategory );
   }
});

