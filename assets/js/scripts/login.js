async function login(event) {
  event.preventDefault();
  email    = document.getElementById("email").value;
  password = document.getElementById("password").value.trim();
  try {
    let response = await fetch("./controllers/auth/login_db.php", {
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
    if(data.status == "success"){
      window.location.href = `./`;
      console.log(data);
    }

    swal.fire({
        icon: "error",
        title: data.massage
      });

  } catch (error) {
    console.log(error);
    swal.fire({
      icon: "error",
      title: `${error.status}`
    })
  }
}