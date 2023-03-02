window.onload = function() {
    // Aggiunge la classe 'selected' all'elemento cliccato
    var fields = document.querySelectorAll('input[type="text"], input[type="password"], input[type="email"], input[type="number"]');
    for (var i = 0; i < fields.length; i++) {
        fields[i].addEventListener('focus', function() {
            this.parentNode.classList.add('selected');
        });
        fields[i].addEventListener('blur', function() {
            this.parentNode.classList.remove('selected');
        });
    }
};