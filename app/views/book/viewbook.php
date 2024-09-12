<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Views Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- <div class="box  bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')] h-[100vh] w-full  flex justify-center items-center "> -->

    <!-- <div class="box h-[100vh] w-full inset-0 bg-black/10 backdrop-blur-md"> -->
        
    <!-- <a href="/login">Login</a> -->

    <h1 class="text-3xl mt-10 mx-20 mb-1 text-gray-950">List Of Books</h1>
    
    <div class="mx-20 ">
        <a href="/addbook">
            <button class="bg-blue-500 rounded-lg py-2 px-5 text-white hover:bg-blue-600 active:bg-blue-700">Add New Books</button> <br>
        </a>
        <div class="mt-2 overflow-auto rounded-lg shadow-lg  bg-gray-100 border-gray-300">
        <table class="books border-collapse w-full">
            <thead class="bg-gray-300 border-b-2 border-gray-300">
                <tr>
                <th class="p-3 text-sm traking-wide text-left">S.N</th>
                <th class="p-3 text-sm traking-wide text-left">Name</th>
                <th class="p-3 text-sm traking-wide text-left">Author</th>
                <th class="p-3 text-sm traking-wide text-left">Publication_year</th>
                <th class="p-3 text-sm traking-wide text-left">Description</th>
                <th class="p-3 text-sm traking-wide text-left">Category</th>
                <th class="p-3 text-sm traking-wide text-left">Quality</th>
                <th class="p-3 text-sm traking-wide text-left">City</th>
                <th class="p-3 text-sm traking-wide text-left">Price</th>
                <th class="p-3 text-sm traking-wide text-left">image</th>
                <th class="p-3 text-sm traking-wide text-left">Action</th>
                </tr>
            </thead>
        
        <?php $i=0;  foreach($books as $book){ ?>
        <tr>
            <td class="p-3 text-sm text-gray-700"> <?php echo ++$i ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['name'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['author'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['publication_year'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['description'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['category_name'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['quality'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['city'] ?>  </td>
            <td class="p-3 text-sm text-gray-700"> <?php echo $book['price'] ?>  </td>
            <td class="p-3 text-sm text-gray-700 h-2 w-2" > <img src="/public/uploads/<?php echo $book['image_url'] ?>" >  </td>

            <td class="p-3 text-sm text-gray-700"> 
              <button class="bg-blue-600 px-3 py-1 m-1 rounded-md text-white hover:bg-blue-700 active:bg-blue-800">  <a href="<?php echo "/editbook/".$book['id'] ?>" >Edit</a>  </button>               
              <!-- </td>
              <td>   -->
              <button class="bg-red-600 px-3 py-1 rounded-md text-white hover:bg-red-700 active:bg-red-800"> <a href="<?php echo "/deletebook/".$book['id'] ?>" >Delete</a> </button> 

                <?php if($book['is_available']){ ?>
              <button class="bg-red-600 mt-2 px-3 py-1 rounded-md text-white hover:bg-red-700 active:bg-red-800"> <a href="<?php echo "/soldbook/".$book['id'] ?>" >Sold</a> </button> 
                    <?php } else {?>
              <button class="bg-green-600 mt-2 px-3 py-1 rounded-md text-white hover:bg-green-700 active:bg-green-800"> <a href="<?php echo "/soldbook/".$book['id'] ?>" >Unsold</a> </button> 
                        <?php }?>
            
            </td>
            
            
        </tr>
        <?php }?>


        </table>
        </div>
    </div>
    <!-- </div> -->
    </div>
</body>
</html>