<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMP Portal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link  rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css" />
</head>
<style>
    .textarea-container {
  display: flex;
  flex-direction: column;
}

.textarea-container .input-group {
  margin-bottom: 1rem;
}
.add-prescription-button {
  width: 40px;
  height: 40px;
  border-radius: 90%;
  background-color: greenyellow;
  color: black;
  font-size: 24px;
  text-align: center;
  line-height: 40px;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-bottom: 10px;
  margin-top:10px;
  justify-content: center;
}
    </style>
<body>
<div class ="container">  
<div class="row mt-5">
  <div class="col-md-6 m-auto">
    <div class="card card-body">
      <h1 class="text-center mb-3">
      <i class="fas fa-medkit" style = "color:#228B22"></i><br>Add New Patient</h1>
      <form action="patientsave.php" method="POST" >
        <div class="form-group">
          <label for="patient">Name</label>
          <input
            type="name"
            id="patient"
            name="patient"
            class="form-control"
            placeholder="Enter Patient Name"
          />
        </div>
        <div class="form-group">
          <label for="patmob">Mob. No.</label>
          <input
            type="number"
            id="patmob"
            name="patmob"
            class="form-control"
            placeholder="Enter Patient Mob. No."
          />
        </div>
        <div class="form-group">
          <label for="patmail">Email</label>
          <input
            type="email"
            id="patmail"
            name="patmail"
            class="form-control"
            placeholder="Enter Patient Email"
          />
      </div>
          <div class="form-group">
          <label for="patage">Age</label>
          <input
            type="number"
            id="patage"
            name="patage"
            class="form-control"
            placeholder="Enter Patient Age"
          />
    </div>
    <div class="form-group">
          <label for="sex">Sex</label>
          <input
            type="name"
            id="sex"
            name="sex"
            class="form-control"
            placeholder="Enter Sex"
          />
        </div>
        <div class="form-group">
            <label for="prescription-textarea">Prescription:</label>
            <div class="textarea-container">
              <div class="prescription-textarea-group">
                <input type = "text" name="prescription[]" id = "search" class="form-control" placeholder="Enter Prescription" style = "margin-bottom:10px;">
                <input type="text" name="dosage[]" class="form-control" placeholder="Enter Dosage & Duration">
                <button type="button" class="add-prescription-button" onclick="addPrescriptionTextarea()">+</button>
              </div>
            </div>
          </div>
</div>
        <button type="submit" class="btn btn-primary btn-block" style = "background-color:#228B22" >
          Submit
        </button>
        </div>
       </div>
      </form>
    </div>
  </div>
</div>
</div>
<script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"
  ></script>
<script>
function addPrescriptionTextarea() {
  // Create a new group of prescription textarea, dosage input, and button
  const prescriptionGroup = document.createElement("div");
  prescriptionGroup.className = "prescription-textarea-group";
  prescriptionGroup.innerHTML = `
  <input type = "text" name="prescription[]" id = "search" class="form-control" placeholder="Enter Prescription" style = "margin-bottom:10px;">
  <input type="text" name="dosage[]" class="form-control" placeholder="Enter Dosage">
  <button type="button" class="add-prescription-button" onclick="addPrescriptionTextarea()">+</button>
  `;

  // Insert the new group after the last group
  const lastPrescriptionGroup = document.querySelector(".prescription-textarea-group:last-of-type");
  lastPrescriptionGroup.parentNode.insertBefore(prescriptionGroup, lastPrescriptionGroup.nextSibling);
}
</script>
  </body>
</html>