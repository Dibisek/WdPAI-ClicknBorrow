const buttons = document.querySelectorAll(".cancel, .confirm")

buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        let clickedButton = event.currentTarget;
        let reservationWrapper = clickedButton.closest('.reservation-box');
        let reservationId = reservationWrapper.getAttribute('id');
        let action = clickedButton.getAttribute('name');
        statusHandler(action,reservationId);
        reservationWrapper.remove();
    })
});

async function statusHandler(decision, reservation_id){
    const data = {
        status: decision,
        reservation_id: reservation_id
    }
    const response = await fetch("/reservationHandler", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
}