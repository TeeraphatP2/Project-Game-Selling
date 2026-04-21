async function login(event) {
  event.preventDefault();
  email    = document.getElementById("email").value;
  password = document.getElementById("password").value.trim();
  try {
    let response = await fetch("./api.php?action=login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email:    email,
        password: password,
      }),
    });

    console.log(response);
    if (!response.ok) {
      throw response;
    }

    let data = await response.json();

    if(!data.status){
      return Swal.fire({
        icon: "warning",
        title: `${data.message}`
      })
    }

    Swal.fire({
      title: "Drag me!",
      icon: "success",
      title: data.message
    });
  
  } catch (error) {
    console.log(error.message);
    swal.fire({
      icon: "error",
      title: `${error}`
    })
  }
}