require('./bootstrap');

let searchContainer = document.querySelector('#bb-search__container');
let searchIcon = document.querySelector('#bb-search__icon');
let searchCloseIcon = document.querySelector('#bb-search__close-icon');

searchIcon.addEventListener('click', expandSearchContainer)
searchCloseIcon.addEventListener('click', closeSearchContainer)

function expandSearchContainer() {
    searchContainer.classList.add("bb-search__container_opened");
    searchIcon.classList.add("bb-search__icon_hiden");
    searchCloseIcon.classList.add("bb-search__close-icon-visible");
}

function closeSearchContainer() {
    searchContainer.classList.remove("bb-search__container_opened");
    searchCloseIcon.classList.remove("bb-search__close-icon-visible");
    setTimeout(() => {
        searchIcon.classList.remove("bb-search__icon_hiden")
    }, 200);
}

