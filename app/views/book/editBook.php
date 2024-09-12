<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="/public/css/styles.css"> -->

</head>

<body>

<div  id="editForm" class="flex justify-center  items-center min-h-screen bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')] bg-cover">
    <div class="p-4 inset-0 flex justify-center items-center">
        <form class="rounded-lg bg-gray-100 border p-6 sm:p-8 mx-2 sm:mx-10 flex flex-col gap-[6px] w-full max-w-lg md:max-w-2xl" method="post" enctype="multipart/form-data" action="/editbook">
            <span class="text-2xl sm:text-3xl text-center text-blue-900 font-bold">Edit Book</span>
            <p class="text-base sm:text-lg text-left text-blue-900 font-bold">Please fill in the required details to edit your product.</p>
           
            <div class="flex flex-col md:flex-row md:gap-6">
            <div class="flex flex-col w-full md:w-1/2 mb-4 md:mb-0">
            <input type="number" value="<?php echo $book['id']  ?>" name="id" hidden>
            </div>
            </div>
            <div class="flex flex-col md:flex-row md:gap-6">
                <div class="flex flex-col w-full md:w-1/2 mb-4 md:mb-0">
                    <label for="bookName" class="mb-2">Book Name</label>
                    <input id="bookName" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" type="text" name="name" placeholder="Enter the Book name" value="<?php echo $book['name'] ?>" required/>
                </div>
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="author" class="mb-2">Author</label>
                    <input id="author" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" type="text" name="author" placeholder="Enter the Author" value="<?php echo $book['author']?>" required/>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:gap-6">
                <div class="flex flex-col w-full md:w-1/2 mb-4 md:mb-0">
                    <label for="price" class="mb-2">Price</label>
                    <input id="price" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" type="text" name="price" placeholder="Enter the Price" value="<?php echo $book['price']?>" required/>
                </div>
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="publicationYear" class="mb-2">Publication Year</label>
                    <input id="publicationYear" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" type="text" name="publication_year" placeholder="Enter the Publication Year" value="<?php echo $book['publication_year']?>" required/>
                </div>
            </div>

            <div class="flex flex-col w-full mb-2">
                <label for="description" class="mb-2">Description</label>
                <textarea id="description" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" name="description" placeholder="Describe the condition of book"  ><?php echo $book['description']?></textarea>
            </div>

            <div class="flex flex-col md:flex-row md:gap-6">
                <div class="flex flex-col w-full md:w-1/2 mb-4 md:mb-0">
                    <label for="category" class="mb-2">Category</label>
                    <select name="category" id="category" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400">
                        <option value="">Select Categories</option>
                        <?php foreach ($categories as $category) { ?>
                            <option <?php  if($book['category_id'] == $category['id']) echo "selected"  ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="city" class="mb-2">City</label>
                    <select name="city" id="city" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" value="<?php echo $book['city']?>">
                        <option value="">Choose the City</option>
                        <option <?php if($book['city'] == "Butwal") echo "selected" ?> value="Butwal">Butwal</option>
                        <option <?php if($book['city'] == "Palpa") echo "selected" ?> value="Palpa">Palpa</option>
                        <option <?php if($book['city'] == "Kathmandu") echo "selected" ?> value="Kathmandu">Kathmandu</option>
                        <option <?php if($book['city'] == "Kapilvastu") echo "selected" ?> value="Kapilvastu">Kapilvastu</option>
                        <option  <?php if($book['city'] == "Gulmi") echo "selected" ?> value="Gulmi">Gulmi</option>
                        <option  <?php if($book['city'] == "Chitwan") echo "selected" ?> value="Chitwan">Chitwan</option>
                        <option  <?php if($book['city'] == "Pokhara") echo "selected" ?> value="Pokhara">Pokhara</option>
                        <option  <?php if($book['city'] == "Syangja") echo "selected" ?> value="Syangja">Syangja</option>
                    </select>
                </div>
            </div>                             

            <div class="flex flex-col w-full mb-2">
                <label for="quality" class="mb-2">Quality</label>
                <select name="quality" id="quality" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400" value="<?php echo $book['quality']?>">
                    <option  value="">Select Quality</option>
                    <option <?php if($book['quality'] == "excellent") echo "selected" ?> value="excellent">Excellent</option>
                    <option <?php if($book['quality'] == "very_good") echo "selected" ?> value="very_good">Very Good</option>
                    <option <?php if($book['quality'] == "good") echo "selected" ?> value="good">Good</option>
                </select>
            </div >
            <div class="flex flex-col w-full mb-2">
            <input id="imageSelect" onchange="handleImage(event)" type="file" accept="image/*" class="p-2 border bg-gray-200 rounded-lg  outline-none focus:outline-gray-400" name="image">
            <img src="/public/uploads/<?php echo $book['image_url'] ?>" >
            </div>
            <div class="flex flex-col w-full">
                <!-- <input type="file" id="myFile" name="filename" class="mt-4 p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400"/> -->
                <button type="submit" class="mt-4 bg-blue-900 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Edit Book</button>
                <a href='/viewbook' class="text-blue-700">View Books </a>
            </div>
        </form>
    </div>
</div>

<script>

function handleImage(e){
    const file = e.target.files[0];
    const image =document.getElementById('image');

    if(!file){
        image.style.display = "none";
        return;
    }//if not file

   const reader = new FileReader();

   reader.onload = (event)=>{
    image.src  = event.target.result;
    image.style.display = "block";
   }
   reader.readAsDataURL(file);
}//

    // scroll edit page

const editFormDiv =document.getElementById("editForm");

editFormDiv.scrollTop = editFormDiv.scrollHeight;

</script>

</body>
</html>

