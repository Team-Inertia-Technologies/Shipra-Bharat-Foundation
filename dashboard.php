<?php
include "includes/common.php";
?>

<body>
    <?php
    include 'load_header.php';
    include '_header.php'; ?>

    <div id="appCapsule">


        <div class="wide-block pt-2 pb-2">

            <div class="row">
                <?php
                // Query the database to get the counts
                $query = "SELECT iCampID, 
                                 SUM(iNumRegs) AS total_registered, 
                                 SUM(iCurrToken) AS total_queue, 
                                 SUM(iNumConsulted) AS total_completed 
                          FROM camp 
                          WHERE cStatus = 'A' 
                          GROUP BY iCampID";
                $result = sql_query($query);

                // Fetch the result
                $total_registered = $total_queue = $total_completed = 0;
                $camp_id = 0;
                if ($row = sql_fetch_assoc($result)) {
                    $total_registered = $row['total_registered'] ?? 0;
                    $total_queue = $row['total_queue'] ?? 0;
                    $total_completed = $row['total_completed'] ?? 0;
                    $camp_id = $row['iCampID'];
                }
                ?>
                <div class="col-4 ">
                    <div class="exampleBox bg1">
                        <img src="assets/img/Book.png" alt="" class="">
                        <div>Registered</div>
                        <div><?= $total_registered; ?></div>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="exampleBox bg2">
                        <img src="assets/img/coin.png" alt="" class="">
                        <div>Queue</div>
                        <div><?= $total_queue; ?></div>
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="exampleBox bg3">
                        <img src="assets/img/Yes.png" alt="" class="">
                        <div>Completed</div>
                        <div><?= $total_completed; ?></div>
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
                                <?php

                                // Fetch registered patients for the camp
                                $query = "SELECT iTokenNum, vName, cStatus 
                                  FROM patient 
                                  WHERE iCampID_reg = '$camp_id'";
                                $result = sql_query($query);

                                if (sql_num_rows($result) > 0) {
                                    while ($row = sql_fetch_assoc($result)) {
                                        $tokenNum = $row['iTokenNum'];
                                        $fullName = $row['vName'];
                                        $status = $row['cStatus'];

                                        // Determine status display
                                        $statusDisplay = '';
                                        $icon = '';
                                        if ($status === 'Q') {
                                            $statusDisplay = 'Q';
                                            $icon = 'assets/img/coin-icon.png';
                                        } elseif ($status === 'C') {
                                            $statusDisplay = 'C';
                                            $icon = 'assets/img/Yes-icon.png';
                                        }

                                        echo "<tr>
                                        <th scope='row'>$tokenNum</th>
                                        <td>$fullName</td>
                                        <td class='text-center f1'>$statusDisplay <img src='$icon' alt='' class=''></td>
                                      </tr>";
                                    }
                                } else {
                                    echo "<tr>
                                    <td colspan='3' class='text-center'>No registered patients found.</td>
                                  </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="fab-button animate bottom-right dropdown">
            <a href="add_patient.php?id=<?php echo $camp_id; ?>" class="fab">
                <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </a>
        </div>

    </div>

    <?php include 'load_footer.php'; ?>
    <!-- <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script> -->
</body>

</html>