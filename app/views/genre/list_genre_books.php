



<?php if(count($books)==0) echo "There are no book of this genre" ?>



<section class="recently-added-books  mx-16  mt-7 p-2">
        <h2 class="text-2xl mb-2 my-5 font-bold text-blue-800">Genre <?php echo $genre ?? '' ?></h2>
    
        <ul class="list flex gap-10 p-5 flex-wrap  ">
            <?php foreach($books as $book) {  ?>
            <li class="product hover:bg-gray-100 hover:scale-105 transition-transform w-52 rounded-lg shadow-lg p-2">
                <a href="/product/<?php echo $book['id'] ?>"> <img src="/public/uploads/<?php echo $book['image_url'] ?>" class="rounded-lg" alt="">
                    <h4 class="text-xl"><?php echo $book['name']?? '' ?></h4>
                    <p class="text-gray-500">By <?php echo $book['author'] ?? '' ?></p>
                    <p class="text-sm">Rs. <?php echo $book['price'] ?> </p>
                </a>
            </li>
            <?php }?>

        </ul>
        <div class="container py-10 px-10 mx-0 min-w-full flex flex-col items-center">
            <button class="button-load font-serif text-1xl text-white bg-blue-700 rounded-lg hover:bg-blue-800 active:bg-blue-900 text-center justify-center px-8 py-2 my-15 ">Load More</button>
        </div>
    </section>