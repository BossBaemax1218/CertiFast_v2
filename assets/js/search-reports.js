function filterDropdownItems(searchValue) {
    const dropdownItems = document.getElementsByClassName("dropdown-item");
    for (let i = 2; i < dropdownItems.length; i++) {
        const itemText = dropdownItems[i].textContent.toLowerCase();
        if (itemText.includes(searchValue.toLowerCase())) {
            dropdownItems[i].style.display = "block";
        } else {
            dropdownItems[i].style.display = "none";
        }
    }
}