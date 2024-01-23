// permet de descendre sur la page de recherche de produits lorsqu'on clique sur la pagination

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner les liens de pagination
    const paginationLinks = document.querySelectorAll('.page-item a');
    paginationLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            // Désactiver le comportement par défaut du lien
            e.preventDefault();
            console.log(link);

            // Obtenir l'URL cible du lien
            const targetUrl = new URL(this.href);

            // Ajouter le hash de la section pour rester au même endroit sur la page
            targetUrl.hash = '#search-products';

            // Rediriger vers l'URL cible
            window.location.href = targetUrl;
        });
    });
});


