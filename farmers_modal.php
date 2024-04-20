<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>RSBA  REGISTRATION</title>
  <style>
    body, input, button, label {
      font-family: 'Century Gothic', sans-serif;
    }
    label{
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="portfolioModalLabel">RSBA REGISTRATION</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h2 class="text-danger"> <span style="font-weight: bold;">REGISTRATION FORM FOR FARMERS</span></h2>
          <p>Please enter the correct information.</p>
          <form id="farmForm" action="code.php" method="POST" enctype="multipart/form-data">
            <div class="form-step" data-step="1">
            <h5>PERSONAL INFORMATION</h5>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="surname" class="form-label">Surname:</label>
                  <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter your Surname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="firstname" class="form-label">First Name:</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your Firstname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="middlename" class="form-label">Middle Name:</label>
                  <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter your Middlename" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="sex" class="form-label">Sex:</label>
                  <select name="sex" id="" class="form-control">
                    <option selected>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="cstatus" class="form-label">Civil Status:</label>
                  <select name="cstatus" id="" class="form-control">
                    <option selected>Select Status</option>
                    <option>Single</option>
                    <option>Married</option>
                    <option>Divorce</option>
                    <option>Widow</option>
                  </select>              
                  </div>
                <div class="col-md-4 mb-3">
                  <label for="cnumber" class="form-label">Contact Number:</label>
                  <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="Enter your Contact Number" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="bldg" class="form-label">Building:</label>
                  <input type="text" class="form-control" id="bldg" name="bldg" placeholder="Enter your Building No." required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="sitio" class="form-label">Sitio:</label>
                  <input type="text" class="form-control" id="sitio" name="sitio" placeholder="Enter your Sitio" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="barangay" class="form-label">Barangay:</label>
                  <select name="barangay" id="" class="form-control">
                    <option selected>Select Barangay</option>
                    <option>Sapad</option>
                    <option>Bugasan Norte</option>
                    <option>Langkong</option>
                    <option>Bugasan Sur</option>
                  </select>                
                  </div>
                <div class="col-md-4 mb-3">
                  <label for="municipality" class="form-label">Municipality:</label>
                  <select name="municipality" id="" class="form-control">
                    <option selected>Matanog</option>
                  </select>                
                  </div>
                <div class="col-md-4 mb-3">
                  <label for="province" class="form-label">Province:</label>
                  <select name="province" id="" class="form-control">
                    <option selected>Maguindanao Del Norte</option>
                  </select>                 </div>
                <div class="col-md-4 mb-3">
                  <label for="region" class="form-label">Region:</label>
                  <select name="region" id="" class="form-control">
                    <option selected>Barmm</option>
                  </select>                 </div>
                <div class="col-md-4 mb-3">
                  <label for="birthday" class="form-label">Birthday:</label>
                  <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="placeofbirth" class="form-label">Place of Birth:</label>
                  <input type="text" class="form-control" id="placeofbirth" name="placeofbirth" placeholder="Enter your Place of Birth" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="education" class="form-label">Education:</label>
                  <select name="education" id="" class="form-control">
                    <option selected>Select Educational attainmaint</option>
                    <option>Elementary</option>
                    <option>High school</option>
                    <option>College</option>
                    <option>Post College</option>
                  </select>        
                         </div>
                <div class="col-md-4 mb-3">
                  <label for="religion" class="form-label">Religion:</label>
                  <select name="religion" id="" class="form-control">
                    <option selected>Select Religion</option>
                    <option>Islam</option>
                    <option>Catholic</option>
                    <option>Born Again</option>
                  </select>           
                            </div>
                <div class="col-md-4 mb-3">
                  <label for="isdisability" class="form-label">Has Disability:</label>
                  <select name="isdisability" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>  
                               </div>
                <div class="col-md-4 mb-3">
                  <label for="is4ps" class="form-label">Is 4Ps Member:</label>
                  <select name="is4ps" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>                  </div>
                <div class="col-md-4 mb-3">
                  <label for="isindigenous" class="form-label">Is Indigenous:</label>
                  <select name="isindigenous" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>                  </div>
                <div class="col-md-4 mb-3">
                  <label for="valid_id" class="form-label">Valid ID:</label>
                  <select name="valid_id" id="" class="form-control">
                    <option selected>Select ID</option>
                    <option>Nationa ID</option>
                    <option>Postal ID</option>
                    <option>Voter's ID</option>
                  </select>                  </div>
                <div class="col-md-4 mb-3">
                  <label for="ishousehead" class="form-label">Is House Head:</label>
                  <select name="ishousehead" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>                 </div>
              </div>
            </div>
            <div class="form-step" data-step="2" style="display: none;">
            <h5>FARMING INFORMATION</h5>
              <div class="row">
              <div class="col-md-4 mb-3">
                  <label for="land_address" class="form-label">Land Address:</label>
                  <input type="text" class="form-control" id="land_address" name="land_address" placeholder="Enter your Farm land address"  required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="land_status" class="form-label">Land Status:</label>
                  <select name="land_status" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Owner</option>
                    <option>Tenant</option>
                  </select>                  </div>
                <div class="col-md-4 mb-3">
                  <label for="land_area" class="form-label">Land Area:</label>
                  <input type="text" class="form-control" id="land_area" name="land_area" placeholder="Enter your Farm land Area (hectars/Meters)"  required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="farming_activity" class="form-label">Farming Activity:</label>
                  <select name="farming_activity" id="" class="form-control">
                    <option selected>Select</option>
                    <option>Corn</option>
                    <option>Rice</option>
                  </select>                 </div>
                <div class="col-md-4 mb-3">
                  <label for="production_income" class="form-label">Production Income:</label>
                  <input type="text" class="form-control" id="production_income" name="production_income"  placeholder="Enter your Production Income" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="income_nonfarming" class="form-label">Income (Non-Farming):</label>
                  <input type="text" class="form-control" id="income_nonfarming" name="income_nonfarming"  placeholder="Enter your Non-Production Income" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="image" class="form-label">Image:</label>
                  <input type="file" class="form-control" id="non" name="image" accept="image/*" capture>
                  <input type="hidden" class="form-control" id="income_nonfarming" name="farming_status" value="farming">

                </div>
              </div>
            </div>
            <div class="form-navigation d-flex justify-content-end"> <!-- Add the justify-content-end class to move buttons to the right -->
              <button type="button" class="btn btn-danger prev-step" style="display: none;">Previous</button> &nbsp;

              <button type="button" class="btn btn-danger next-step">Next</button> 
              <button type="submit" class="btn btn-success" style="display: none;" name="submit_agri_farm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/farmers.js"></script>
</body>
</html>
