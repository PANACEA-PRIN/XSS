function dos() {
    while (true) {
        // Creare un elemento DOM per ogni iterazione
        var elem = document.createElement('div');
        document.body.appendChild(elem);
    }
}

// Eseguire la funzione intensiveTask
setTimeout(dos(), 1);