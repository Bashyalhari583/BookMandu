


    <section id="productDisplay" class="section_padding">
        <div class="main flex justify-start gap-[30px] " id="maindisplay">
            <div class="mainImage">
                <img src="/public/uploads/<?php echo $book['image_url'] ?>" alt=" ">
            </div>
            <div class="information">
                <div class="bookinformation flex justify-start gap-[10px]">
                    <h5 class="text-3xl font-bold text-[#123573]"><?php echo $book['name'] ?></h5>
                   <div class="text-2xl font-bold text-[#123573]">Rs. <?php echo $book['price'] ?></div> 
                    <div class="text-xl font-bold " type="button"><?php echo $category ?></div>
                    <p class="mb-3"><?php echo $book['description'] ?></p>
                </div>

                <?php  if($auth){ ?>

                    <div class="mt-4 p-5 w-[400px] bg-gray-100 rounded-lg shadow-2xl flex flex-col justify-start gap-[10px] ">
                        <div class="text-xl text-blue-700 mx-2">Sellers Details</div>
                             <div class="imgname">
                              <img  class="profileimage mx-2" src ="/public/uploads/<?php echo $seller['profile_pic'] ?>" alt="img">
                                <h5><?php echo $seller['name'] ?></h5>
                             </div>
                            <div><i class="fa-solid fa-envelope mx-2"></i><span><?php echo $seller['email'] ?></span></div>
                            <div><i class="fa-solid fa-phone mx-2"></i><span><?php echo $seller['phone'] ?></span></div>
                            <div class="flex gap-8">
                            <a class="text-white px-2 py-1 bg-blue-500 rounded-lg hover:bg-blue-600 active:bg-blue-700 " href="/message/<?php echo $seller['id'] ?>"><i class="fa-brands fa-rocketchat mx-2"></i> Chat with Seller</a>
                            <a class="text-white px-2 py-1 bg-blue-500 rounded-lg hover:bg-blue-600 active:bg-blue-700 " href="/profile/<?php echo $seller['id'] ?>"> <i class="fa-solid fa-user mx-2"></i> Visit Profile</a>
                            </div>
                           
                           
                    </div>
            <?php }else{?>

            <a class="border text-blue-700 hover:bg-white hover:scale-105 hover:shadow-xl rounded-lg shadow-lg p-3" href="/login">Please <span class="text-blue-900 hover:text-blue-500 active:text-blue-300">login</span> to view seller details!</a>
            <?php }?>

            <button class="py-2 text-white mt-6 px-4 rounded-lg bg-blue-600">
                <a  href="/pay/<?php echo $book['id']?>">Buy Book</a>

            </button>



        </div>



       

        </div>
        


        <h2 id="helper" class="text-2xl mb-2 my-10 p-6 font-bold text-blue-800 mx-16">Similar Books </h2>

<ul id="list_box" class=" list flex gap-16 p-5 flex-wrap mx-16  ">
    <?php foreach ($recommends as $book) {  ?>
        <li class="product hover:bg-gray-100 hover:scale-105 transition-transform w-52 border-2 border-solid border-[#ebedf3] rounded-lg shadow-lg p-2">
            <a href="/product/<?php echo $book['id'] ?>"> <img src="/public/uploads/<?php echo $book['image_url'] ?>" class="rounded-lg" alt="">
                <h4 class="text-xl"><?php echo $book['name'] ?? '' ?></h4>
                <p class="text-gray-500">By <?php echo $book['author'] ?? '' ?></p>
                <p class="text-sm">Rs. <?php echo $book['price'] ?> </p>
            </a>
        </li>
    <?php } ?>

</ul>




    </section>