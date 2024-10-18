function calculate() {
    const num1 = parseFloat(document.getElementById("num1").value);
    const num2 = parseFloat(document.getElementById("num2").value);
    const operation = document.getElementById("operation").value;
    let result = 0;

    if (isNaN(num1) || isNaN(num2)) {
        alert("Por favor, ingrese numeros validos");
        return;
    }

    switch (operation) {
        case 'sum':
            result = num1 + num2;
            break;
        case 'sub':
            result = num1 - num2;
            break;
        case 'mul':
            result = num1 * num2;
            break;
        case 'div':
            if (num2 == 0) {
                alert("No se puede dividir entre cero");
            } else {
                result = num1 / num2;
            }
            break;
        default:
            alert("Operacion no valida");
    }

    document.getElementById("result").innerText = result;

}