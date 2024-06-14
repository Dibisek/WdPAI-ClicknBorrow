const inputsValue = document.querySelectorAll("form select, form input");

async function filterBooks(){
    const data = {}
    inputsValue.forEach(input => {
        data[input.name] = input.value
    });

    console.log(data)
    const response = await fetch("/filterBooks", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const cars = await response.json();
    console.log(cars)
}




inputsValue.forEach(input => input.addEventListener("change", filterBooks));