<?php include 'load_header.php'; ?>
<body>
    <?php include '_header.php'; ?>

    <div id="appCapsule">


        <div class="wide-block pt-2 pb-2">

            <div class="row">
                <div class="col-4 ">
                    <div class="exampleBox bg1">
                        <img src="assets/img/Book.png" alt="" class="">
                        <div>Registered</div>
                        <div>100</div>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="exampleBox bg2">
                        <img src="assets/img/coin.png" alt="" class="">
                        <div>Queue</div>
                        <div>60</div>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="exampleBox bg3">
                        <img src="assets/img/Yes.png" alt="" class="">
                        <div>Completed</div>
                        <div>40</div>
                    </div>
                </div>
            </div>

        </div>



        <div class="section mt-3 mb-3">
            <div class="card bg-light1">
                <div class="card-body">
                    <h5 class="card-title">Registered</h5>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Token no.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">60</th>
                                    <td>Chinmay Palekar</td>
                                    <td class="text-center f1">Q <img src="assets/img/coin-icon.png" alt="" class=""></td>
                                </tr>
                                <tr>
                                    <th scope="row">61</th>
                                    <td>Yogesh Chodankar</td>
                                    <td class="text-center f1">C <img src="assets/img/Yes-icon.png" alt="" class=""></td>
                                </tr>
                                <tr>
                                    <th scope="row">62</th>
                                    <td>Sushmita Gawas</td>
                                    <td class="text-center f1">C <img src="assets/img/Yes-icon.png" alt="" class=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>


        <div class="fab-button animate bottom-right dropdown">
            <a href="add_patient.php" class="fab" >
                <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </a>
        </div>

    </div>

    <?php include 'load_footer.php'; ?>
    <!-- <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script> -->
</body>

</html>