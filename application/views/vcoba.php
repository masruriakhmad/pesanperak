<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>

  <title>Form dengan Live Image Preview</title>
<script>
              var loadFile = function (event) {
                var output = document.getElementById('prev');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function () {
                  URL.revokeObjectURL(output.src)
                  // free memory
                }
              };
            </script>

</head>

<body>

  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12">
        <h1 class="mt-4"> Form dengan Live Image Preview</h1>

        <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label for="nama"></label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
            <small id="Nama yag jelas" class="text-muted">Nama Kamu</small>
          </div>

          
          <div class="form-group">
            <label for="upload">Upload file</label>
            <input type="file" class="form-control-file" name="upload" id="preview" placeholder="Upload"
              aria-describedby="fileHelpId" onChange="loadFile(event)">
          </div>
          
          <div>
            <br><img src="" width="200px" height="215px" id="prev">
          </div>

          
	    <button type="submit" class="btn btn-primary">Simpan</button> 


        </form>
      </div>
    </div>
  </div>


 

</body>

</html>