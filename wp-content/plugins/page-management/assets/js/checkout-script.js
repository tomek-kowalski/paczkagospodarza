document.addEventListener("DOMContentLoaded", function () {
    var homeLink = document.querySelector('#breadcrumbs span span a');
    homeLink.innerText = 'Sklep';

    var breadcrumbSpan = document.querySelector('#breadcrumbs span');
    breadcrumbSpan.innerHTML = breadcrumbSpan.innerHTML.replace('»', '/');

    var infoDiv = document.querySelector('.woocommerce-info');
    var newElement = document.createElement('span');
    newElement.innerText = ' Informacja ';
    newElement.classList.add('info-text'); 
    
    console.log(infoDiv);
    
    if (infoDiv) {
        infoDiv.insertBefore(newElement, infoDiv.firstChild);
    }
    
    

});

