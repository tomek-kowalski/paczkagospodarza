document.addEventListener("DOMContentLoaded", function () {
    minusBread();
});

function minusBread() {
    const sklepBreadcrumbSpan = document.querySelector('.woocommerce-breadcrumb span');
    const sklepBreadcrumb = document.querySelector('.woocommerce-breadcrumb');

    sklepBreadcrumbSpan.remove();

    if (sklepBreadcrumb) {
        sklepBreadcrumb.innerHTML = sklepBreadcrumb.innerHTML.replace(/^\s*\/\s*/, '');
    }
    
}





