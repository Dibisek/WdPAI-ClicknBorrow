const button = document.querySelector("button");
const inputs = document.querySelectorAll("input");
let startDate, endDate, isValid;
function validateForm(){
    startDate = new Date(inputs[1].value);
    endDate = new Date(inputs[2].value);
    const currentDate = new Date();
    isValid = true;
    console.log(startDate,endDate);

    if (startDate.getTime() < currentDate.getTime()) {
        isValid = false;
    }

    if(!startDate.getTime() || !endDate.getTime()){
        isValid = false;
    }

    if (startDate.getTime() >= endDate.getTime()) {
        isValid = false;
    }

    button.disabled = !isValid;
    console.log(startDate,endDate, isValid);
}

inputs.forEach(input => input.addEventListener("change", validateForm));
validateForm()