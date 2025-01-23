<?php include 'load_header.php'; ?>

<body>
   <?php include '_header.php'; ?>
   <div id="appCapsule">
      <a href="result.php">
         <button type="button" class="btn text-left">
            <span class="btn-icon-wrapper "> <i class="back-arrow-icon"> </i> </span>
            <span class="text4 ">Home</span> </button>
      </a>
      <div class="section mt-1">
         <div class="card">
            <div class="card-body">
               <div class="todo-indicator "></div>
               <div class="d-flex jc-sb ai-center">
                  <div class="ml-1">
                     <div>Lexman Kubal</div>
                     <div>+919876543210 | Male (30)</div>
                  </div>
                  <div class="exampleBox bg2  w-20">
                     <img src="assets/img/coin.png" alt="" class="">
                     <div>69</div>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="section mt-2">
         <div class="card">
            <div class="card-header">
               Attending Doctor
            </div>
            <div class="card-body">
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown">
                     Dr. Sujeet Sheety
                  </button>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="#">Option 1</a>
                     <a class="dropdown-item" href="#">Optin 2</a>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="section mt-2">
         <div class="card">
            <div class="card-header d-flex jc-sb ai-center">

               Diagnosis

               <button type="button" class="btn btn-icon btn-sm btn-primary" data-toggle="modal" data-target="#actionSheetShare">
                  <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
               </button>

            </div>
            <div class="card-body">
               <ul class="diag">
                  <li>Diabetes</li>
                  <li>Kidney</li>
               </ul>
            </div>
         </div>
      </div>

      <div class="section mt-2">
         <div class="card">
            <div class="card-header">

               Prescription

            </div>
            <div class="card-body">


               <div class="row ai-center">
                  <div class="col-9">

                     <div class="form-group boxed">
                        <div class="photoblock">
                           <div class="upload-box">
                              <label for="file-upload-2" class="upload-button">
                                 <img src="assets/img/upload.png" alt="image">&nbsp; Upload
                              </label>
                              <input id="file-upload-2" type="file" accept="image/*" onchange="displayImageName(2)">
                              <div id="image-name-2" class="image-name">No image uploaded</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-3">
                     <span class="text-right text-black"><a href="#"><span class="blue"><b><u>View photo</u></b></span></a></span>
                  </div>
               </div>

               <div class="section inset py-2 bg2 mt-2">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
               </div>


            </div>
         </div>

         <div class="mt-2">
            <a href="#" class="btn btn-black btn-block">SAVE</a>
         </div>
      </div>



      <div class="modal fade action-sheet inset" id="actionSheetShare" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Share with</h5>
                        <a href="#" class="btn btn-secondary btn-block btn-lg" data-dismiss="modal">Close</a>
                    </div>
                    <div class="modal-body">
                        <ul class="action-button-list">
                            <li>
                                <a href="#" class="btn btn-list" data-dismiss="modal">
                                    <span>
                                        <ion-icon name="logo-facebook"></ion-icon>
                                        Facebook
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-dismiss="modal">
                                    <span>
                                        <ion-icon name="logo-twitter"></ion-icon>
                                        Twitter
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-dismiss="modal">
                                    <span>
                                        <ion-icon name="logo-instagram"></ion-icon>
                                        Instagram
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-dismiss="modal">
                                    <span>
                                        <ion-icon name="logo-linkedin"></ion-icon>
                                        Linkedin
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


   </div>
   <?php include 'load_footer.php'; ?>
   <!-- <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
   <script src="assets/js/lib/popper.min.js"></script>
   <script src="assets/js/lib/bootstrap.min.js"></script>
   <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script> -->
   <script>
      function displayImageName(index) {
         const fileInput = document.getElementById(`file-upload-${index}`);
         const imageName = document.getElementById(`image-name-${index}`);

         if (fileInput.files.length > 0) {
            imageName.textContent = fileInput.files[0].name;
         } else {
            imageName.textContent = 'No image uploaded';
         }
      }
   </script>

</body>

</html>