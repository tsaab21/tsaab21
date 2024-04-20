<style>
    .sign {
        color: white;
        background-color: green;
        width: 150px;
        height: 40px;
        border-radius: 5px; /* Add a border-radius to round the corners */
        border-color: white;
        transition: background-color 0.3s, color 0.3s, border-radius 0.3s; /* Add a smooth transition */
    }

    .sign:hover {
        background-color: white;
        color: green;
        border-radius: 5px; /* Adjust the border-radius on hover */
    }
    .another {
    color: black;
    background-color: rgba(255, 255, 255, 0); /* Transparent white background */
    width: 80px;
    height: 40px;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s, border-radius 0.3s;
}


    .another:hover {
        background-color: green;
        color: white;
        border-radius: 5px; /* Adjust the border-radius on hover */
    }
</style>
<!-- 
<li class="nav-item">
    <a class="nav-link" href="login.php">
        <button>SIGNIN</button>
    </a>
</li> -->

<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><span class="text-danger">AGRI</span> MATANOG</a>
    <button class="navbar-toggler btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon btn btn-danger"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#services"><button class="another">Home</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about"><button class="another">About</button></a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="#team"><button class="another">Team</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php"><button class="another">Gallery</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#map"><button class="another">Map</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contactinfo"><button class="another">Contact</button></a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#contact"><button class="another">Feedback</button></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="login">
            <button class="sign">Signin</button>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>