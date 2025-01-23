<?php include 'load_header.php'; ?>
<body class="bg-blue">
   <div id="appCapsule" class="pt-0">
      <div class="login-form mt-1">
         <div class="section">
            <img src="assets/img/design.png" alt="image" class="w-100">
         </div>
         <div class="section mt-1">
            <img src="assets/img/logo.png" alt="image">
            <h3 class="text-white mt-5">Amet minim mollit non deserunt ullamco</h3>
         </div>
         <div class="section mt-1 mb-5">
            <form action="app-pages.html">
               <div class="form-group boxed">
                  <div class="input-wrapper">
                     <label class="label text-white" for="name1">username</label>
                     <input type="text" class="form-control" id="" placeholder="Username">
                  </div>
               </div>
               <div class="form-group boxed">
                  <div class="input-wrapper">
                     <label class="label text-white" for="name1">Password</label>
                     <input type="password" class="form-control" id="password1" placeholder="Password">
                  </div>
               </div>
               <a href="dashboard.php" class="btn btn-primary btn-block btn-lg mt-4">NEXT</a>
               
            </form>
         </div>
      </div>
   </div>
   <?php include 'load_footer.php'; ?>
</body>
</html>