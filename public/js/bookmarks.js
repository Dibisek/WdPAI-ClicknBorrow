// Select all bookmark buttons
const bookmarkButtons = document.querySelectorAll(".bookmark");
bookmarkButtons.forEach(bookmarkButton => bookmarkButton.addEventListener("click", function () {
    const bookmarkText = this.closest('.bookmark-container').querySelector(".bookmark-text span");
    const container = this.closest(".func-container").parentElement;
    const id = container.getAttribute("id");

    fetch(`/addBookmark/${id}`)
        .then(function () {

            if (document.querySelector('.bookmark.pressed') == null) {
                document.querySelector(".bookmark").classList.add('pressed');
                if (!bookmarkText == null) {
                    bookmarkText.innerText = "Bookmarked";
                    bookmarkText.classList.add('pressed');
                }
                bookmarkButton.getElementsByTagName('i')[0].classList.remove('fa-regular');
                bookmarkButton.getElementsByTagName('i')[0].classList.add('fa-solid');

            } else {
                document.querySelector(".bookmark").classList.remove('pressed');
                if (!bookmarkText == null) {
                    bookmarkText.innerText = "Add to Bookmark";
                    bookmarkText.classList.remove('pressed');
                }
                bookmarkButton.getElementsByTagName('i')[0].classList.remove('fa-solid');
                bookmarkButton.getElementsByTagName('i')[0].classList.add('fa-regular');

            }
        });
}));
