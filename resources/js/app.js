require('./bootstrap');

let searchContainer = document.querySelector('#bb-search__container');
let searchIcon = document.querySelector('#bb-search__icon');
let searchCloseIcon = document.querySelector('#bb-search__close-icon');
let searchInputButton = document.querySelector('#search_input_button');

searchIcon.addEventListener('click', expandSearchContainer)
searchCloseIcon.addEventListener('click', closeSearchContainer)

function expandSearchContainer() {
    searchContainer.classList.add("bb-search__container_opened");
    searchIcon.classList.add("bb-search__icon_hiden");
    searchCloseIcon.classList.add("bb-search__close-icon-visible");
    searchInputButton.classList.add("bb-search__button_show");
}

function closeSearchContainer() {
    searchContainer.classList.remove("bb-search__container_opened");
    searchCloseIcon.classList.remove("bb-search__close-icon-visible");
    searchInputButton.classList.remove("bb-search__button_show");
    setTimeout(() => {
        searchIcon.classList.remove("bb-search__icon_hiden")
    }, 200);
}

