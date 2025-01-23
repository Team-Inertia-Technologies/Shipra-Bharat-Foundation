<?php include 'load_header.php'; ?>

<body>
    <?php include '_header.php'; ?>

    <div id="appCapsule">


        <div class="section mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="todo-indicator "></div>
                    <div class="ml-1">
                        <div>Mobile Number</div>
                        <div>+919876543210</div>
                    </div>

                </div>
            </div>
        </div>

        <div class="wide-block pt-2 ">
            <div class="text1">Patient Details</div>
            <p class="text-gray">Enter the patient’s detail below to continue</p>
        </div>


        <div class="wide-block pb-2">

            <form>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Name</label>
                        <input type="text" class="form-control" id="" placeholder="Eg: David Noronha" required="">
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Age</label>
                                <input type="text" class="form-control" id="" placeholder="Eg: 26" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Gender</label>
                                <select class="form-control custom-select" id="" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Transgender</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Blood Pressure(mm Hg)</label>
                                <input type="text" class="form-control" id="" placeholder="Eg: 26" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Weight(kgs)</label>
                                <input type="text" class="form-control" id="" placeholder="Eg: 86" required="">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Sugar(mg/dL)</label>
                                <input type="text" class="form-control" id="" placeholder="Eg: 70" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Smoking</label>
                                <select class="form-control custom-select" id="" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Known Illness</label>
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb1">
                                        <label class="custom-control-label" for="customCheckb1">Hypertension</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb2">
                                        <label class="custom-control-label" for="customCheckb2">Diabetes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb3">
                                        <label class="custom-control-label" for="customCheckb3">Heart</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb4">
                                        <label class="custom-control-label" for="customCheckb4">Kidney</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb5">
                                        <label class="custom-control-label" for="customCheckb5">Liver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb6">
                                        <label class="custom-control-label" for="customCheckb6">Stomach</label>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb7">
                                        <label class="custom-control-label" for="customCheckb7">Neuro</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb8">
                                        <label class="custom-control-label" for="customCheckb8">Gastro</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb9">
                                        <label class="custom-control-label" for="customCheckb9">Lungs</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb10">
                                        <label class="custom-control-label" for="customCheckb10">Urology</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb11">
                                        <label class="custom-control-label" for="customCheckb11">Gynac</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb12">
                                        <label class="custom-control-label" for="customCheckb12">Others</label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>







                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Symptoms if any </label>
                        <textarea id="" rows="3" class="form-control"></textarea>
                    </div>
                </div>




                <div class="mt-2">
                    <a href="patient_details.php" class="btn btn-primary btn-block">SAVE</a>
                </div>

            </form>


        </div>

    </div>

    <?php include 'load_footer.php'; ?>
</body>

</html>