<?php include 'load_header.php'; ?>

<body>
    <?php include '_header.php'; ?>

    <div id="appCapsule">


        <div class="wide-block pt-2 pb-2">


            <div class="text1">Patient Mobile Number</div>
            <p class="text-gray">Enter the patient’s mobile number below to continue</p>

            <form action="app-pages.html">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label text-black" for="">Mobile number</label>
                        <input type="tel" class="form-control" id="" placeholder="+91">
                    </div>
                </div>
                <a href="add_patient_details.php" class="btn btn-primary btn-block btn-lg mt-4">NEXT</a>
                <a href="dashboard.php" class="btn btn-block btn-lg mt-4">SKIP</a>
            </form>

        </div>



    </div>

    <?php include 'load_footer.php'; ?>
</body>

</html>