let search_input = document.getElementById('search_input');
let search_input_button = document.getElementById('search_input_button');


window.onload = function () {
    if (search_input.value.length == 0)
        search_input_button.disabled = true
};
search_input.addEventListener('input', updateValue);

function updateValue(e) {
    function сheckSpaces(str) {
        return str.trim() !== '';
    }

    if (!сheckSpaces(e.target.value)) {
        search_input_button.disabled = true
    } else {
        search_input_button.disabled = false
        search_input.value = 0
    }
}


