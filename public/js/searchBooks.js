const inputsValue = document.querySelectorAll("form select, form input");
const booksContainer = document.querySelector(".books-container");
const paginationWrapper = document.querySelector(".paginationWrapper");

let currentPage = 1;
let booksPerPage = getBooksPerPage();
let books;

function getBooksPerPage(){
    return window.innerWidth <= 1024 ? 3 : 6;
}

window.addEventListener("resize", () => {
    const newBooksPerPage = getBooksPerPage();
    if (newBooksPerPage !== booksPerPage){
        booksPerPage = newBooksPerPage;
        currentPage = 1;
        renderBooks(books, currentPage);
        renderPagination(books);
    }
});

async function filterBooks(){
    const data = {}
    inputsValue.forEach(input => {
        console.log(input.value);
        data[input.name] = input.value;
    });

    const response = await fetch("/filterBooks", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });


    books = await response.json();
    renderBooks(books, currentPage);
    renderPagination(books);
}

function renderBooks(books, page){
    booksContainer.innerHTML = "";

    if (books.length == 0){
        booksContainer.innerHTML = "<h2>No books found</h2>";
        return;
    }

    const start = (page - 1) * booksPerPage;
    const end = start + booksPerPage;
    const paginatedBooks = books.slice(start, end);

    paginatedBooks.forEach(book => {
        createBookCard(book);
    });
}

function renderPagination(books){
    paginationWrapper.innerHTML = "";

    if (books.length <= booksPerPage) return;

    const pages = Math.ceil(books.length / booksPerPage);

    for (let i = 1; i <= pages; i++){
        const pageBtn = document.createElement("button");
        pageBtn.textContent = i;
        pageBtn.classList.add("pageBtn");
        if (i === currentPage) pageBtn.classList.add("active");

        pageBtn.addEventListener("click", () => {
            currentPage = i;
            console.log(booksContainer.getBoundingClientRect().x);
            window.scrollTo({ top: booksContainer.getBoundingClientRect().y, behavior: "smooth" });
            renderBooks(books, currentPage);
            updateActivePageBtn();
        });
        paginationWrapper.appendChild(pageBtn);
    }
}

function updateActivePageBtn(){
    const pageBtns = paginationWrapper.querySelectorAll(".pageBtn");
    pageBtns.forEach(btn => {
        btn.classList.remove("active");
        if (parseInt(btn.textContent) === currentPage) btn.classList.add("active");
    });
}

function createBookCard(book){
    const template = document.querySelector("#book-template");
    const clone = template.content.cloneNode(true);

    const img = clone.querySelector("img");
    const desc = clone.querySelector(".description");
    const title = clone.querySelector(".book-title");
    const author = clone.querySelector(".book-author");
    const bookLink = clone.querySelector("div > a:last-child");

    img.src = "public/img/uploads/" + book.photo;

    desc.textContent = book.description;
    title.textContent = book.title;
    author.textContent = book.author_name;
    bookLink.href = "/bookDetails?id=" + book.book_id;
    booksContainer.appendChild(clone);
}

inputsValue.forEach(input => input.addEventListener("change", () => {
    currentPage = 1;
    filterBooks();
}))

filterBooks();