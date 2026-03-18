<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <!-- <link rel="stylesheet" href="styles.css" /> -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .item {
  border: 2px solid rgb(95 97 110);
  border-radius: 0.5em;
  padding: 20px;
  width: 10em;
}

.container {
  border: 2px solid rgb(75 70 74);
  border-radius: 0.5em;
  font: 1.2em sans-serif;

  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

  </style>
</head>

<body>
  <div class="container">
  <div class="item">I am centered!</div>
  <button id="normalButton">Normal Button</button>
  <button id="sweetAlertButton">SweetAlertButton</button>
</div>
<script> 
function alertSweet(){
  Swal.fire({
  title: "Drag me!",
  icon: "success",
  
});
};
  document.getElementById("normalButton").addEventListener("click", function(){
    alert("This is normal button");
  });
  document.getElementById("sweetAlertButton").addEventListener("click", alertSweet);
</script>
</body>

</html>