document.addEventListener("DOMContentLoaded", function () {
    addingBread();
});

function addingBread() {
    const sklepBreadcrumb = document.querySelector('.woocommerce-breadcrumb span');

    const sklepText = 'Sklep';
    if (sklepBreadcrumb.innerText.includes(sklepText)) {
        sklepBreadcrumb.innerHTML = sklepBreadcrumb.innerHTML.replace(sklepText, '');

        const link = document.createElement("a");

        link.href = window.location.origin;

        link.innerText = sklepText;

        sklepBreadcrumb.appendChild(link);
    }
    const separator = document.createElement("span");

    separator.innerText = '/Dziś w promocji';
    sklepBreadcrumb.appendChild(separator);
}
