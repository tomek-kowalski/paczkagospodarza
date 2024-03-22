document.addEventListener("DOMContentLoaded", function () {
    var homeLink = document.querySelector('#breadcrumbs span span a');
    homeLink.innerText = 'Sklep';

    var breadcrumbSpan = document.querySelector('#breadcrumbs span');
    breadcrumbSpan.innerHTML = breadcrumbSpan.innerHTML.replace('»', '/');

    var infoDiv = document.querySelector('.woocommerce-info');
    var newElement = document.createElement('span');
    newElement.innerText = ' Informacja ';
    newElement.classList.add('info-text'); 

    var account = document.querySelector('.woocommerce-account-fields');
    var shipping = document.querySelector('.woocommerce-shipping-fields');
    var note = document.querySelector('#order_comments_field');
    
    if (shipping && account && note) {
        note.insertAdjacentElement('afterend', account);
        note.insertAdjacentElement('afterend', shipping);
    }
    for (var i = 0; i < infoDiv.childNodes.length; i++) {
        var node = infoDiv.childNodes[i];
        if (node.nodeType === Node.TEXT_NODE && node.textContent.includes('Masz już konto?')) {
            infoDiv.removeChild(node);
            break; 
        }
    }

/* 
    var label = document.querySelector('label[for="shipping_method_0_flat_rate3"]');
    var labelText = label.textContent;

    console.log(labelText);
    setTimeout(function() {
        label.innerHTML = labelText.replace(/^([^<]+)$/g, '<span>$1</span>');
    }, 4000);


    console.log(label); */
 
    if (infoDiv) {
        infoDiv.insertBefore(newElement, infoDiv.firstChild);
        var spanElement = document.createElement('span');
        spanElement.classList.add('info-question');
        spanElement.innerText = 'Masz już konto?'; 
        infoDiv.appendChild(spanElement);
    }
    
    

});

