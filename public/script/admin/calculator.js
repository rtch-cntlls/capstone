function pressNum(num) {
    let input = document.getElementById("amount_paid");
    input.value = input.value + num;
    computeChange();
}

function clearInput() {
    document.getElementById("amount_paid").value = "";
    document.getElementById("change_display").innerHTML = "";
}

function computeChange() {
    const total = window.orderTotal; 
    const paid = parseFloat(document.getElementById("amount_paid").value) || 0;
    const change = paid - total;

    document.getElementById("change").value = change >= 0 ? change.toFixed(2) : 0;

    if (paid > 0) {
        if (change >= 0) {
            document.getElementById("change_display").innerHTML =
                `Change: <span class="text-success">₱${change.toFixed(2)}</span>`;
        } else {
            document.getElementById("change_display").innerHTML =
                `<span class="text-danger">Insufficient Amount</span>`;
        }
    } else {
        document.getElementById("change_display").innerHTML = "";
    }
}


