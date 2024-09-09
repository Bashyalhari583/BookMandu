<style>
  body {
    background: #666;
    /* font-family: 'Lato', sans-serif; */
    color: #000;
    margin: 0;
    padding: 0;
  }

  .profile-header {
    position: relative;
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
  }

  .profile-header img.cover-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-bottom: 1px solid #ccc;
    /* border-radius: 200px solid #ccc; */
  }

  .profile-header .profile-img {
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 5px solid #fff;
    background-color: #fff;
  }

  .profile-header .profile-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
  }

  .profile-header h3 {
    position: absolute;
    bottom: -100px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 24px;
    font-weight: 700;
    color: #333;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 5px 15px;
    border-radius: 10px;
  }

  .profile-content {
    margin-top: 85px;
  }

  .card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    border-radius: 10px;
    overflow: hidden;
  }

  .card-header {
    background-color: #123573;
    color: white;
    font-weight: bold;
    padding: 10px;
    border-radius: 10px 10px 0 0;
    /* margin-left: 50px; */
  }

  .card-body {
    padding: 20px;
  }

  .card-body p {
    margin-bottom: 10px;
    font-size: 16px;
  }

  .table th,
  .table td {
    font-size: 14px;
    padding: 10px;
    color: #000;
  }

  .social-icons {
    display: flex;
    justify-content: center;
    margin-top: 25px;
  }
  #fab{
  color: #123573;

}

  .social-icons a {
    color: #123573;
    margin: 0 10px;
    font-size: 24px;
    transition: transform 0.2s;
  }

  .social-icons a:hover {
    transform: scale(1.2);
  }

  #btn-primary {
    background-color: #123573;
    border-color: #123573;
    margin-bottom: 20px;
  }

  .btn-primary:hover {
    background-color: #12336d;
    border-color: #12336d;
  }

  .btn-danger {
    background-color: #12336d;
    border-color: #12336d;
  }
  button{
    margin-bottom: 20px;
  }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<form style="display: none;" enctype="multipart/form-data" id="profile_pic_form" action="/update_profile_image" method="post">
    <input id="profile_pic_file" type="file" accept="image/*" name="profile_pic">
</form>

<form style="display: none;" enctype="multipart/form-data" id="profile_cover_form" action="/update_profile_image" method="post">
    <input id="profile_cover_file" type="file" accept="image/*" name="cover_pic">
</form>

<div class="container">

      <div class="profile-header">
        <img id="profile_cover_image" src="/public/uploads/<?php echo $profile['cover_pic'] ?>" class="cover-photo" alt="Cover Photo">
        <div class="profile-img hover:scale-110">
          <img id="profile_pic_image" class="hover:scale-110 shadow-lg" src="/public/uploads/<?php echo $profile['profile_pic']?>" alt="Profile Picture">
        </div>
        <h3><?php echo $profile['name']." (&#9733;" .$rating;?> )</h3>
      </div>

      <div class="profile-content">
        <div class="social-icons">
          <a href="#"><i id="fab" class="fab fa-facebook-f"></i></a>
          <a href="#"><i id="fab" class="fab fa-twitter"></i></a>
          <a href="#"><i id="fab" class="fab fa-instagram"></i></a>
          <a href="#"><i id="fab" class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="row">


          <div class="col-lg-12">
            <div class="card shadow-sm">
              <div class="card-header">
               Profile Details
              </div>
              <div class="card-body">

                <table class="table table-bordered">
                  <tr>
                    <th width="30%">Full Name</th>
                    <!-- <td width="2%">:</td> -->
                    <td><?php echo $profile['name'] ?></td>
                  </tr>
                  <tr>
                    <th width="30%">Email</th>
                    <!-- <td width="2%">:</td> -->
                    <td><?php echo $profile['email']; ?></td>
                  </tr>
                  <tr>
                    <th width="30%">Phone No</th>
                    <!-- <td width="2%">:</td> -->
                    <td><?php echo $profile['phone']; ?></td>
                  </tr>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php  if($user->id == $profile['id']){?>

      <!-- Trigger the modal with a button -->
      <center><button type="button" id="btn-primary" class="btn btn-lg btn-primary bg-blue-900" data-toggle="modal" data-target="#myModal">Update Profile</button></center>
    
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" >
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title " >Update Profile</h4>
            </div>
            <div class="modal-body">
              <form method="POST" action="/update_profile">
                <div class="form-group">
                  <label for="full_name">Full Name:</label>
                  <input type="text" class="form-control" id="full_name" value="<?php echo $profile['name']; ?>" name="name">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" value="<?php echo $profile['email']; ?>"  readonly>
                </div>
                <div class="form-group">
                  <label for="phone_no">Phone No.:</label>
                  <input type="text" class="form-control" id="phone_no" value="<?php echo $profile['phone']; ?>" name="phone">
                </div>
            
              
                
                <hr>
                <center><button id="submit" type="submit" class="btn btn-primary btn-block">Update</button></center><br>
              </form>
           

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

      <?php }?>



    </div>

</div>




<?php if($is_rating) {?>

<div class=" flex items-center justify-center">
    <div class="bg-white  p-20 rounded-lg shadow-md">
        <form action="/rating" method="POST" class="rating-form">
            <input type="hidden" name="id" value="<?php echo $profile['id'] ?>"> <!-- Replace with dynamic book ID -->
            <div class="stars flex flex-row-reverse justify-center space-x-reverse space-x-2 mb-4">
                <input type="radio" id="star5" name="rating" value="5" class="hidden" />
                <label for="star5" class="text-7xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star4" name="rating" value="4" class="hidden" />
                <label for="star4" class="text-7xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                <label for="star3" class="text-7xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star2" name="rating" value="2" class="hidden" />
                <label for="star2" class="text-7xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star1" name="rating" value="1" class="hidden" />
                <label for="star1" class="text-7xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">Submit Rating</button>
        </form>
        <div id="feedback" class="mt-4 text-center"></div> <!-- Feedback message container -->
    </div>

</div>

<?php }?>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.rating-form');
            const stars = document.querySelectorAll('.stars input');
            const labels = document.querySelectorAll('.stars label');
            const feedback = document.getElementById('feedback'); // Feedback element

            // Highlight stars based on selection
            stars.forEach(input => {
                input.addEventListener('change', function() {
                    // Highlight selected stars
                    labels.forEach(label => {
                        label.classList.toggle('text-yellow-500', label.htmlFor <= 'star' + this.value);
                        label.classList.toggle('text-gray-400', label.htmlFor > 'star' + this.value);
                    });
                });
            });

           
        });
    </script>



<script>

  var profile_pic_file =document.getElementById("profile_pic_file");
  var profile_pic_form =document.getElementById("profile_pic_form");

  var profile_cover_form =document.getElementById("profile_cover_form");
  var profile_cover_file =document.getElementById("profile_cover_file");

  var profile_cover_image =document.getElementById("profile_cover_image");
  var profile_pic_image =document.getElementById("profile_pic_image");


  profile_cover_image.addEventListener("click",()=>{
    profile_cover_file.click();
  })

  profile_cover_file.addEventListener('change',(e)=>{
      const file = e.target.files[0];
      if(file){
        profile_cover_form.submit();
        // alert("File is ready to be uploaded");
      }//
  })


  profile_pic_image.addEventListener("click",()=>{
    profile_pic_file.click();
  })

  profile_pic_file.addEventListener('change',(e)=>{
      const file = e.target.files[0];
      if(file){
        profile_pic_form.submit();
        // alert("File is ready to be uploaded");
      }//
  })

</script>
