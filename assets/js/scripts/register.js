async function register(event){
    event.preventDefault();
    const firstname = document.getElementById('firstname').value;
    const lastname = document.getElementById('lastname').value;
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const cpassword = document.getElementById('cpassword').value.trim();
    const emailWrongFormat = document.getElementById('emailWrongFormat');

    const checkEmailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!checkEmailFormat.test(email)) {
        emailWrongFormat.classList.add('show');
        return;
        
    }
    emailWrongFormat.classList.remove('show');

    try{
        const response = await fetch('./api.php?action=register', {
        method: 'POST',
        headers: {
        "Content-Type": "application/json",
      },
        body: JSON.stringify({
            firstname: firstname,
            lastname: lastname,
            email: email,
            password: password,
            cpassword: cpassword
        })
    })

    let data = await response.json();

    console.log(data.message);
    swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: data.message
    })
    
    }catch(error){
        swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.status
        })
    }
}