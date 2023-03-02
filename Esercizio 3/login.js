const form = document.querySelector('.login-form');
const namelogin = document.querySelector('#namelogin');
const passwordlogin = document.querySelector('#passwordlogin');

form.addEventListener('submit', e =>
{
	e.preventDefault();
	
	// verifica se i campi di input sono vuoti
	if(namelogin.value.trim() === '' || passwordlogin.value.trim() === '')
	{
		alert('Inserisci le tue credenziali di accesso');
		return;
	}
	
	// invia il modulo
	form.submit();
});